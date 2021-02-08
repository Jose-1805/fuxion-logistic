<div class="">
    {!! Form::open(['id'=>'form-nombres-departamentos']) !!}
        {!! Form::hidden('departamento',$departamento->id) !!}
        @forelse($operadores_logisticos as $ol)
            <div class="form-group col-md-6">
                {!! Form::label('ol_'.$ol->id,$ol->nombre) !!}
                {!! Form::text('ol_'.$ol->id,$ol->departamento,['class'=>'form-control']) !!}
            </div>
        @empty
            <p class="text-center">No existe información para mostrar.</p>
        @endforelse
    {!! Form::close() !!}
</div>