<div>
    <!-- CSS -->
    <style type="text/css">
        .search-box .clear{
            clear:both;
            margin-top: 20px;
        }

        .search-box ul{
            list-style: none;
            padding: 0px;
            width: 90%;
            position: absolute;
            margin: 0;
            background: white;
            z-index: 99;
        }

        .search-box ul li{
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .search-box ul li:nth-child(even){
            background: cadetblue;
            color: white;
        }

        .search-box ul li:hover{
            cursor: pointer;
        }

        {{-- .search-box input[type=text]{
            padding: 5px;
            width: 250px;
            letter-spacing: 1px;
        } --}}
    </style>
    <div class="input-group">
        <input type='text' class="form-control" wire:model="search" wire:keyup="searchResult">
        <div class="input-group-append">
            <a data-toggle="modal" href="#createPeopleModal" class="btn btn-outline-success" wire:emit="resetPeopleInputFields"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </a>
        </div>
    </div>
    <div class="search-box">
        <!-- Search result list -->
        @if($showresult)
            <ul >
                @if(!empty($records))
                    @foreach($records as $record)

                         <li wire:click="fetchPeopleDetail({{ $record->id }})">{{ $record->people_type}}{{ $record->id_card}} {{ $record->name}} {{ $record->lastname}}</li>

                    @endforeach
                @endif
            </ul>
        @endif

        <div class="clear"></div>
    </div>

</div>

