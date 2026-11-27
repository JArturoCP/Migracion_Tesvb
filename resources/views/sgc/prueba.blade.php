@extends('layouts.panel')
@section('title','Agendar auditorias')
@include('partials.panel.recursos_app', ['ordenable' => true])
@section('content')
<div class="tw-pantalla">
<style>
    .margin-top-30 {
        margin-top: 30px;
    }

    .banner-component,
    .important-links-component {
        height: 465px;
    }

    .training-status-component {
        height: 178px;
    }

    .learning-activities-component {
        height: 394px;
    }

    .popular-courses-component,
    .resources-component,
    .news-and-updates-component {
        height: 438px;
    }
</style>

<x-panel.encabezado titulo="Heading" :migas="['Sistema de gestión de calidad' => null]" />
    <div class="margin-top-30 tw:w-full">
    <div class="component-container tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="component-section tw:lg:w-9/12 tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-9 col-sm-6 col-xs-12" data-wrapper="bannerwrapper" data-componentname="Banner" data-componenttype="Complex">
            <div class="panel banner-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Banner</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-3/12 tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-3 col-sm-6 col-xs-12" data-wrapper="importantlinkswrapper" data-componentname="ImportantLinks" data-componenttype="Simple">
            <div class="panel important-links-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Important Links</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-full tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-12 col-sm-6 col-xs-12" data-wrapper="trainingstatuswrapper" data-componentname="TrainingStatus" data-componenttype="Mediocre">
            <div class="panel training-status-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Training Status</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-full tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-12 col-sm-6 col-xs-12" data-wrapper="learningactivitieswrapper" data-componentname="LearningActivities" data-componenttype="Simple">
            <div class="panel learning-activities-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Learning Activities</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-4/12 tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-4 col-sm-6 col-xs-12" data-wrapper="popularcourseswrapper" data-componentname="PopularCourses" data-componenttype="Simple">
            <div class="panel popular-courses-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Popular Courses</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-4/12 tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-4 col-sm-6 col-xs-12" data-wrapper="resourceswrapper" data-componentname="Resources" data-componenttype="Mediocre">
            <div class="panel resources-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Resources</h1>
                </div>
            </div>
        </div>

        <div class="component-section tw:lg:w-4/12 tw:md:w-6/12 tw:w-full tw:px-2" data-width="col-md-4 col-sm-6 col-xs-12" data-wrapper="newsandupdateswrapper" data-componentname="NewsAndUpdates" data-componenttype="Simple">
            <div class="panel news-and-updates-component tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Heading</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">News And Updates</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.component-container').sortable({
            cursor: 'move',
            placeholder: 'ui-state-highlight',
            start: function(e, ui) {
                ui.placeholder.width(ui.item.find('.panel').width());
                ui.placeholder.height(ui.item.find('.panel').height());
                ui.placeholder.addClass(ui.item.attr("class"));
            }
        });
    });

</script>
</div>
@endsection
