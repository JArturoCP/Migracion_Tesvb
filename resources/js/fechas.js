import flatpickr from 'flatpickr';
import { Spanish } from 'flatpickr/dist/l10n/es.js';
import 'flatpickr/dist/flatpickr.css';
import '../css/fechas.css';

const formats = {
    date: ['Y-m-d', 'd/m/Y', 'DD/MM/AAAA', 'fecha'],
    'datetime-local': ['Y-m-d\\TH:i', 'd/m/Y H:i', 'DD/MM/AAAA HH:MM', 'fecha y hora'],
    time: ['H:i', 'H:i', 'HH:MM', 'hora'],
};
const selector = 'input[type=date], input[type=time], input[type=datetime-local], input[type=text][data-flatpickr-date]';
const controls = new Map();
const valueProperty = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value');
const typeOf = input => input.hasAttribute('data-flatpickr-date') ? 'date' : input.type;
function formatOf(input) {
    const format = input.getAttribute('data-flatpickr-date');
    return ['d/m/Y', 'd-m-Y', 'Y/m/d'].includes(format)
        ? [format, ...formats.date.slice(1)]
        : formats[typeOf(input)];
}
let openPicker;
let sequence = 0;

function compatible(input) {
    return !input.matches('[data-stepper-requerido], [list]')
        && !input.closest('[data-no-flatpickr], .input-daterange, [data-provide=datepicker]')
        && !input._flatpickr
        && !window.jQuery?.data(input, 'datepicker')
        && (controls.has(input) || !Object.hasOwn(input, 'value'))
        && (typeOf(input) === 'date' ? ['', '1', 'any'].includes(input.getAttribute('step') ?? '') :
            ['', '60', 'any'].includes(input.getAttribute('step') ?? '')
            && ![input.value, input.min, input.max].some(value => /:\d{2}:\d{2}/.test(value)));
}

function parse(value, format) {
    if (!value) return undefined;
    const patterns = {
        'Y-m-d': /^\d{4}-\d{2}-\d{2}$/,
        'd/m/Y': /^\d{2}\/\d{2}\/\d{4}$/,
        'd-m-Y': /^\d{2}-\d{2}-\d{4}$/,
        'Y/m/d': /^\d{4}\/\d{2}\/\d{2}$/,
        'Y-m-d\\TH:i': /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/,
        'd/m/Y H:i': /^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}$/,
        'H:i': /^\d{2}:\d{2}$/,
    };
    if (!patterns[format].test(value)) return undefined;
    const date = flatpickr.parseDate(value, format, false, Spanish);
    return date && flatpickr.formatDate(date, format, Spanish) === value ? date : undefined;
}

function sync(input, control, refresh = true) {
    const { field, button } = control;
    control.value = input.value;
    const [format, display, , label] = formatOf(input);
    if (refresh) {
        const date = parse(input.value.trim(), format);
        field.value = date ? flatpickr.formatDate(date, display, Spanish) : input.value;
        control.invalid = false;
    }
    const disabled = input.matches(':disabled');
    if (field.disabled !== disabled) field.disabled = disabled;
    if (field.readOnly !== input.readOnly) field.readOnly = input.readOnly;
    if (field.required !== input.required) field.required = input.required;
    if (button.disabled !== (disabled || input.readOnly)) button.disabled = disabled || input.readOnly;
    for (const attr of ['aria-labelledby', 'aria-describedby', 'aria-errormessage', 'aria-invalid', 'form']) {
        const value = input.getAttribute(attr);
        if (field.getAttribute(attr) === value) continue;
        if (value === null) field.removeAttribute(attr);
        else field.setAttribute(attr, value);
    }
    const labelText = input.getAttribute('aria-label') || Array.from(input.labels ?? [], item => item.textContent.trim()).join(' ');
    field.setAttribute('aria-label', labelText || input.placeholder || label);
    button.setAttribute('aria-label', labelText ? 'Elegir ' + label + ': ' + labelText : 'Elegir ' + label);
    field.setCustomValidity(control.invalid ? 'Usa el formato ' + field.placeholder + '.' : input.validationMessage);
}

function dispatch(input, control, name) {
    control.emitting = true;
    try {
        input.dispatchEvent(new Event(name, { bubbles: true }));
    } finally {
        control.emitting = false;
    }
}

function write(input, control, value, manual = false) {
    const previous = input.value;
    valueProperty.set.call(input, value);
    if (input.value !== previous) {
        dispatch(input, control, 'input');
        if (!manual) dispatch(input, control, 'change');
    }
    if (!manual) control.committed = input.value;
    sync(input, control, !manual);
}

function position(picker, anchor) {
    const calendar = picker.calendarContainer;
    const bounds = anchor.getBoundingClientRect();
    const left = Math.max(4, Math.min(bounds.left, document.documentElement.clientWidth - calendar.offsetWidth - 4));
    const top = bounds.bottom + calendar.offsetHeight <= window.innerHeight
        ? bounds.bottom
        : Math.max(4, bounds.top - calendar.offsetHeight);
    Object.assign(calendar.style, { left: left + 'px', top: top + 'px' });
}

function show(input, control, keyboard) {
    const { field, button } = control;
    if (openPicker?.control === control) {
        if (keyboard) openPicker.focus();
        return;
    }
    openPicker?.picker.close();
    if (!compatible(input) || button.disabled) return;

    const type = typeOf(input);
    const [dateFormat] = formatOf(input);
    const timeOnly = type === 'time';
    const relative = input.getAttribute('data-flatpickr-min-days');
    const minDate = new Date();
    minDate.setDate(minDate.getDate() + Number(relative));

    // Flatpickr controla el popup. La entrada original conserva tipo, etiquetas y semántica del formulario.
    const proxy = document.createElement('input');
    const picker = flatpickr(proxy, {
        locale: Spanish,
        dateFormat,
        ariaDateFormat: 'j F Y',
        defaultDate: parse(input.value.trim(), dateFormat),
        minDate: timeOnly ? undefined : input.min || (relative === null ? undefined : minDate),
        maxDate: timeOnly ? undefined : input.max || undefined,
        minTime: timeOnly ? input.min || undefined : undefined,
        maxTime: timeOnly ? input.max || undefined : undefined,
        enableTime: type !== 'date',
        noCalendar: timeOnly,
        time_24hr: true,
        minuteIncrement: 1,
        disableMobile: true,
        clickOpens: false,
        ignoredFocusElements: [field, button],
        appendTo: input.closest('.modal, dialog, [aria-modal="true"]') || document.body,
        position: instance => position(instance, field),
        onValueUpdate(_, value) {
            if (button.disabled) return;
            write(input, control, value);
        },
        onClose() {
            if (openPicker?.control === control) openPicker = undefined;
            for (const trigger of [field, button]) {
                trigger.setAttribute('aria-expanded', 'false');
                trigger.removeAttribute('aria-controls');
            }
            if (picker.calendarContainer.contains(document.activeElement)) field.focus({ preventScroll: true });
            queueMicrotask(() => picker.destroy());
        },
    });
    const calendar = picker.calendarContainer;
    calendar.classList.add('tesvb-calendario');
    const appearance = getComputedStyle(field);
    calendar.style.fontFamily = appearance.fontFamily;
    // El tema común se hereda en vivo. Solo se copia un acento local que el popup no herede.
    const inherited = getComputedStyle(calendar);
    for (const token of ['--color-brand-600', '--tw-color-brand-600', '--tw-color-brand-500']) {
        const accent = appearance.getPropertyValue(token).trim();
        if (accent && accent !== inherited.getPropertyValue(token).trim()) {
            calendar.style.setProperty('--calendario-acento', accent);
            break;
        }
    }
    calendar.id = button.id + '-dialogo';
    calendar.setAttribute('role', 'dialog');
    calendar.setAttribute('aria-label', button.getAttribute('aria-label'));
    calendar.addEventListener('keydown', event => {
        if (event.key !== 'Escape') return;
        event.preventDefault();
        event.stopImmediatePropagation();
        picker.close();
    }, true);
    const focus = () => {
        const day = calendar.querySelector('.selected:not(.flatpickr-disabled)')
            || calendar.querySelector('.today:not(.flatpickr-disabled)')
            || calendar.querySelector('.flatpickr-hour, .flatpickr-day:not(.flatpickr-disabled)');
        day?.focus({ preventScroll: true });
    };
    openPicker = { control, picker, focus };
    for (const trigger of [field, button]) {
        trigger.setAttribute('aria-expanded', 'true');
        trigger.setAttribute('aria-controls', calendar.id);
    }
    picker.open();
    if (keyboard) focus();
}

function add(input) {
    if (controls.has(input) || !compatible(input)) return;
    const container = document.createElement('span');
    container.className = 'tesvb-fecha-control';
    if (input.matches('.form-control, [class$="w-full"], [class*="w-full "]')) {
        container.classList.add('tesvb-fecha-ancho');
    }

    const field = document.createElement('input');
    field.type = 'text';
    field.className = input.className;
    field.classList.add('tesvb-fecha-visible');
    field.autocomplete = 'off';
    field.placeholder = formatOf(input)[2];
    field.setAttribute('aria-haspopup', 'dialog');
    field.setAttribute('aria-expanded', 'false');

    const button = document.createElement('button');
    button.type = 'button';
    do {
        button.id = 'tesvb-fecha-' + ++sequence;
    } while (document.getElementById(button.id));
    button.className = 'tesvb-fecha';
    button.setAttribute('aria-haspopup', 'dialog');
    button.setAttribute('aria-expanded', 'false');

    const control = {
        container, field, button, committed: input.value,
        tabindex: input.getAttribute('tabindex'), ariaHidden: input.getAttribute('aria-hidden'),
        focus: () => field.focus({ preventScroll: true }),
        cancelClick: event => {
            event.preventDefault();
            control.focus();
        },
    };
    controls.set(input, control);
    // Vue y jQuery escriben en value sin emitir eventos cuando actualizan el DOM.
    Object.defineProperty(input, 'value', {
        configurable: true,
        get() { return valueProperty.get.call(this); },
        set(value) {
            const previous = valueProperty.get.call(this);
            valueProperty.set.call(this, value);
            if (!control.emitting && previous !== this.value) {
                control.committed = this.value;
                sync(this, control);
            }
        },
    });

    if (control.tabindex !== null) field.setAttribute('tabindex', control.tabindex);
    input.setAttribute('tabindex', '-1');
    input.setAttribute('aria-hidden', 'true');
    input.classList.add('tesvb-fecha-original');
    input.addEventListener('focus', control.focus);
    input.addEventListener('click', control.cancelClick);
    input.before(container);
    container.append(field, button);
    sync(input, control);

    button.addEventListener('click', () => {
        if (openPicker?.control === control) openPicker.picker.close();
        else show(input, control, true);
    });
    field.addEventListener('click', () => show(input, control, false));
    field.addEventListener('keydown', event => {
        if (event.key === 'ArrowDown' && event.altKey) {
            event.preventDefault();
            show(input, control, true);
        } else if (event.key === 'Escape' && openPicker?.control === control) {
            event.preventDefault();
            event.stopPropagation();
            openPicker.picker.close();
        }
    });
    field.addEventListener('input', event => {
        event.stopPropagation();
        if (openPicker?.control === control) openPicker.picker.close();
        const [format, display] = formatOf(input);
        const text = field.value.trim();
        const parsed = parse(text, display) || parse(text, format);
        control.invalid = Boolean(text && !parsed);
        const value = parsed ? flatpickr.formatDate(parsed, format, Spanish)
            : input.hasAttribute('data-flatpickr-date') ? text : '';
        write(input, control, value, true);
    });
    field.addEventListener('change', event => {
        event.stopPropagation();
        if (control.committed !== input.value) {
            control.committed = input.value;
            dispatch(input, control, 'change');
        }
        if (!control.invalid) sync(input, control);
    });
}

function remove(input, control) {
    if (openPicker?.control === control) openPicker.picker.close();
    input.removeEventListener('focus', control.focus);
    input.removeEventListener('click', control.cancelClick);
    for (const [attr, value] of [['tabindex', control.tabindex], ['aria-hidden', control.ariaHidden]]) {
        if (value === null) input.removeAttribute(attr);
        else input.setAttribute(attr, value);
    }
    delete input.value;
    input.classList.remove('tesvb-fecha-original');
    control.container.remove();
    controls.delete(input);
}

function scan(node) {
    if (node instanceof Element && node.matches(selector)) add(node);
    node.querySelectorAll?.(selector).forEach(add);
}

function start() {
    scan(document);
    new MutationObserver(records => {
        for (const record of records) {
            if (record.type === 'attributes') {
                scan(record.target);
                if (openPicker && openPicker.control === controls.get(record.target) && ['min', 'max'].includes(record.attributeName)) {
                    openPicker.picker.close();
                }
            }
            record.addedNodes.forEach(scan);
        }
        for (const [input, control] of controls) {
            if (!input.isConnected || !input.matches(selector) || !compatible(input)) {
                remove(input, control);
                continue;
            }
            if (input.parentNode !== control.container.parentNode) input.before(control.container);
            sync(input, control, control.value !== input.value);
            if (control.button.disabled && openPicker?.control === control) openPicker.picker.close();
        }
    }).observe(document.body, {
        subtree: true,
        childList: true,
        attributes: true,
        attributeFilter: ['disabled', 'readonly', 'required', 'type', 'data-no-flatpickr', 'data-flatpickr-date', 'value', 'min', 'max', 'step', 'list', 'form', 'aria-invalid', 'aria-describedby'],
    });

    for (const name of ['input', 'change', 'invalid']) {
        document.addEventListener(name, event => {
            const control = controls.get(event.target);
            if (control && !control.emitting) sync(event.target, control, name !== 'invalid');
        }, true);
    }
    document.addEventListener('reset', event => {
        openPicker?.picker.close();
        setTimeout(() => {
            if (event.defaultPrevented) return;
            for (const [input, control] of controls) {
                if (input.form !== event.target) continue;
                control.committed = input.value;
                sync(input, control);
            }
        });
    });
    window.addEventListener('scroll', event => {
        if (openPicker && !openPicker.picker.calendarContainer.contains(event.target instanceof Node ? event.target : null)) {
            position(openPicker.picker, openPicker.control.field);
        }
    }, true);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start, { once: true });
} else {
    start();
}
