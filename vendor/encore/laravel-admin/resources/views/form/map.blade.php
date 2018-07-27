<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id['lat']}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        @include('admin::form.error')
        <div class="input-group">
            <span class="input-group-addon" for="">搜索</span>
            <input class="form-control" id="keyword_{{$id['lat'].$id['lng']}}" value="">
            <span class="btn btn-info input-group-addon" type="button" id="btn_{{$id['lat'].$id['lng']}}">GO</span>
        </div>
        <hr>
        <div id="map_{{$id['lat'].$id['lng']}}" style="width: 100%;height: 300px"></div>
        <input type="hidden" id="{{$id['lat']}}" name="{{$name['lat']}}"
               value="{{ old($column['lat'], $value['lat']) }}" {!! $attributes !!} />
        <input type="hidden" id="{{$id['lng']}}" name="{{$name['lng']}}"
               value="{{ old($column['lng'], $value['lng']) }}" {!! $attributes !!} />
        <hr>
        <div style="width: 100%;" id="info_{{$id['lat'].$id['lng']}}"></div>
        @include('admin::form.help-block')

    </div>
</div>
