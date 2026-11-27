@php($alcanceTd = $alcanceTd ?? '[data-panel-estudiante]')
<style>
    {!! $alcanceTd !!} {
        --td-surface: #fff;
        --td-base: #f7f9fc;
        --td-ink: #172438;
        --td-muted: #475569;
        --td-border: #dce4ee;
        --td-accent-ink: color-mix(in srgb, var(--td-accent), #152035 74%);
        --td-tint: color-mix(in srgb, var(--td-accent) 9%, var(--td-surface));
        --td-focus: #2854a1;
        --td-info: #254776;
        --td-info-bg: #edf4ff;
        --td-pending: #75501c;
        --td-pending-bg: #fff5df;
        --td-success: #176049;
        --td-success-bg: #e7f7ef;
        position: relative;
        isolation: isolate;
        container-type: inline-size;
        display: grid;
        gap: clamp(1.25rem, 3cqi, 2rem);
        min-width: 0;
        color: var(--td-ink);
    }
    .dark {!! $alcanceTd !!} {
        --td-surface: #1f2937;
        --td-base: #111827;
        --td-ink: #f1f5f9;
        --td-muted: #cbd5e1;
        --td-border: #3b485d;
        --td-accent-ink: color-mix(in srgb, var(--td-accent), #f4f7fd 72%);
        --td-focus: #a9c8ff;
        --td-info: #c1d8ff;
        --td-info-bg: #233a55;
        --td-pending: #ffe0a0;
        --td-pending-bg: #483923;
        --td-success: #a5ead0;
        --td-success-bg: #233e37;
    }
    {!! $alcanceTd !!} .td-backdrop {
        position: absolute;
        z-index: -1;
        inset: 0;
        overflow: hidden;
        border-radius: 1.25rem;
        background: var(--td-base);
        pointer-events: none;
        mask-image: linear-gradient(black 65%, transparent);
    }
    {!! $alcanceTd !!} .td-backdrop svg { width: 100%; height: 100%; color: var(--td-accent); }
    {!! $alcanceTd !!} .td-hero {
        position: relative;
        isolation: isolate;
        display: grid;
        align-items: center;
        align-content: center;
        gap: 1rem;
        overflow: hidden;
        min-height: 15.5rem;
        padding: clamp(1.25rem, 5cqi, 3.25rem);
        border: 1px solid var(--td-border);
        border-inline-start: 4px solid var(--td-accent);
        border-radius: 1.25rem;
        background: linear-gradient(113deg, var(--td-surface) 25%, color-mix(in srgb, var(--td-accent) 17%, var(--td-surface)));
    }
    {!! $alcanceTd !!} .td-hero-waves,
    {!! $alcanceTd !!} .td-mascot {
        position: absolute;
        pointer-events: none;
        z-index: -1;
    }
    {!! $alcanceTd !!} .td-hero-waves {
        inset: 0;
        width: 100%;
        height: 100%;
        color: var(--td-accent);
    }
    {!! $alcanceTd !!} .td-mascot {
        width: clamp(11rem, 35cqi, 21rem);
        height: auto;
        right: 1%;
        bottom: -26%;
        opacity: .11;
    }
    {!! $alcanceTd !!} .td-hero-copy { min-width: 0; max-width: 44rem; overflow-wrap: anywhere; }
    {!! $alcanceTd !!} .td-label { color: var(--td-accent-ink); font-size: .875rem; font-weight: 700; }
    {!! $alcanceTd !!} .td-hero h1 {
        margin: .55rem 0 .65rem;
        font-size: clamp(1.7rem, 4.6cqi, 3.25rem);
        line-height: 1.09;
        letter-spacing: -.035em;
        font-weight: 750;
    }
    {!! $alcanceTd !!} .td-career { font-size: clamp(1rem, 2cqi, 1.2rem); font-weight: 600; }
    {!! $alcanceTd !!} .td-meta { display: flex; flex-wrap: wrap; gap: .5rem; margin: 1.25rem 0 0; }
    {!! $alcanceTd !!} .td-meta > div { padding: .45rem .7rem; border-radius: .5rem; background: var(--td-surface); }
    {!! $alcanceTd !!} .td-meta dt { font-size: .75rem; color: var(--td-muted); }
    {!! $alcanceTd !!} .td-meta dd { margin: 0; font-size: .875rem; font-weight: 650; }
    {!! $alcanceTd !!} .td-logo { width: 7.5rem; height: 7.5rem; object-fit: contain; justify-self: end; }
    {!! $alcanceTd !!} .td-heading { margin: 0 0 .85rem; font-size: 1.16rem; line-height: 1.25; font-weight: 720; }
    {!! $alcanceTd !!} .td-section { border: 1px solid var(--td-border); background: var(--td-surface); border-radius: 1rem; padding: clamp(1rem, 3cqi, 1.55rem); }
    {!! $alcanceTd !!} .td-access-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .75rem; }
    {!! $alcanceTd !!} .td-access {
        display: flex;
        align-items: center;
        gap: .75rem;
        height: 100%;
        min-height: 5rem;
        padding: .8rem;
        border: 1px solid var(--td-border);
        border-radius: .8rem;
        color: var(--td-ink);
        background: var(--td-surface);
        overflow-wrap: anywhere;
        transition: background-color .16s, border-color .16s;
    }
    {!! $alcanceTd !!} a.td-access:hover { background: var(--td-tint); border-color: var(--td-accent-ink); }
    {!! $alcanceTd !!} .td-access-icon {
        display: grid;
        place-items: center;
        width: 2.5rem;
        height: 2.5rem;
        flex: none;
        border-radius: .65rem;
        background: var(--td-tint);
        color: var(--td-accent-ink);
    }
    {!! $alcanceTd !!} .td-access-icon svg { color: inherit; }
    {!! $alcanceTd !!} .td-access-title { display: block; font-weight: 700; }
    {!! $alcanceTd !!} .td-muted { color: var(--td-muted); font-size: .875rem; }
    {!! $alcanceTd !!} a:focus-visible { outline: 2px solid var(--td-focus); outline-offset: 3px; }
    {!! $alcanceTd !!} .td-credits { display: grid; margin: 0; }
    {!! $alcanceTd !!} .td-stat { min-width: 0; padding: 1rem 0; }
    {!! $alcanceTd !!} .td-stat + .td-stat { border-block-start: 1px solid var(--td-border); }
    {!! $alcanceTd !!} .td-stat h3 { font-size: .875rem; font-weight: 700; }
    {!! $alcanceTd !!} .td-count { display: flex; flex-wrap: wrap; gap: .35rem; align-items: baseline; margin: .3rem 0 .65rem; }
    {!! $alcanceTd !!} .td-count strong { font-size: 1.95rem; line-height: 1; letter-spacing: -.025em; font-variant-numeric: tabular-nums; }
    {!! $alcanceTd !!} .td-pill { display: inline-block; padding: .24rem .55rem; border-radius: .4rem; font-size: .75rem; font-weight: 700; background: var(--td-base); color: var(--td-muted); }
    {!! $alcanceTd !!} .td-pill--info { color: var(--td-info); background: var(--td-info-bg); }
    {!! $alcanceTd !!} .td-pill--pending { color: var(--td-pending); background: var(--td-pending-bg); }
    {!! $alcanceTd !!} .td-pill--success { color: var(--td-success); background: var(--td-success-bg); }
    {!! $alcanceTd !!} .td-segments { display: flex; gap: .25rem; margin: .75rem 0; }
    {!! $alcanceTd !!} .td-segments span { flex: 1; height: .4rem; border-radius: .25rem; background: var(--td-border); }
    {!! $alcanceTd !!} .td-segments .is-earned { background: var(--td-accent); }
    {!! $alcanceTd !!} .td-news li { padding: .8rem 0; }
    {!! $alcanceTd !!} .td-news li + li { border-block-start: 1px solid var(--td-border); }
    {!! $alcanceTd !!} .td-news p { overflow-wrap: anywhere; }
    {!! $alcanceTd !!} .td-news-title { margin: .32rem 0 .18rem; font-weight: 650; }
    {!! $alcanceTd !!} .td-news a { display: inline-flex; align-items: center; min-height: 44px; color: var(--td-info); text-decoration: underline; }
    {!! $alcanceTd !!} .td-empty { padding: .75rem 1rem; background: var(--td-base); border-inline-start: 2px solid var(--td-border); border-radius: .35rem; }
    @container (min-width: 34rem) {
        {!! $alcanceTd !!} .td-hero--logo { grid-template-columns: minmax(0, 1fr) 8.75rem; }
        {!! $alcanceTd !!} .td-logo { width: 8.25rem; height: 8.25rem; }
    }
    @container (min-width: 48rem) {
        {!! $alcanceTd !!} .td-access-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        {!! $alcanceTd !!} .td-credits { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        {!! $alcanceTd !!} .td-stat { padding: .35rem 1rem; }
        {!! $alcanceTd !!} .td-stat:first-child { padding-inline-start: 0; }
        {!! $alcanceTd !!} .td-stat + .td-stat { border-block-start: 0; border-inline-start: 1px solid var(--td-border); }
    }
    @container (max-width: 33.99rem) {
        {!! $alcanceTd !!} .td-mascot { display: none; }
        {!! $alcanceTd !!} .td-logo { justify-self: start; width: 5rem; height: 5rem; }
    }
    @container (max-width: 25rem) {
        {!! $alcanceTd !!} .td-access-grid { grid-template-columns: minmax(0, 1fr); }
    }
    @media (prefers-reduced-motion: reduce) {
        {!! $alcanceTd !!} .td-access { transition: none; }
    }
</style>
