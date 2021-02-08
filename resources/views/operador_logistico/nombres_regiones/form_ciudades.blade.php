<div class="">
    {!! Form::open(['id'=>'form-nombres-ciudades']) !!}
        {!! Form::hidden('ciudad',$ciudad->id) !!}
        @forelse($operadores_logisticos as $ol)
            <div class="form-group col-md-6">
                {!! Form::label('ol_'.$ol->id,$ol->nombre) !!}
                {!! Form::text('ol_'.$ol->id,$ol->ciudad,['class'=>'form-control']) !!}
            </div>
        @empty
            <p class="text-center">No existe información para mostrar.</p>
        @endforelse
    {!! Form::close() !!}
</div>