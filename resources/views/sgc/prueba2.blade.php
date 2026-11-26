@extends('layouts.panel')
@include('partials.panel.recursos_app', ['ordenable' => true])
@section('title','Agendar auditorias')
@section('content')
    <style>
        .ui-draggable, .ui-droppable {
            background-position: top;
        }
        ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
        li { margin: 5px; padding: 5px; width: 150px; }
        #sortable > div {
            background: #1f6377;
            width: 33.3333333333% !important;
        }
    </style>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div id="draggable" class="ui-state-highlight tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-6/12 tw:px-2">Drag me down</div>
</div>



<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="sortable">
    <div class="ui-state-default tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-3/12 tw:px-2">Item 1</div>
    <div class="ui-state-default tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-3/12 tw:px-2">Item 2</div>
    <div class="ui-state-default tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-3/12 tw:px-2">Item 3</div>
    <div class="ui-state-default tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-3/12 tw:px-2">Item 4</div>
    <div class="ui-state-default tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:lg:w-3/12 tw:px-2">Item 5</div>
</div>


<script>
    $( function() {
        $( "#sortable" ).sortable({
            revert: true
        });
        $( "#draggable" ).draggable({
            connectToSortable: "#sortable",
            helper: "clone",
            revert: "invalid"
        });
        $( "ul, li" ).disableSelection();
    } );
</script>
@endsection
