<form method="post" action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}">                    
    @csrf
    <select name="produto_id">
        <option>--Selecione um Produto--</option>

        @foreach ($produtos as $produto)
            <option value="{{ $produto->id }}" {{ (old('produto')) == $produto->id ? 'selected' : '' }}>{{ $produto->nome }}</option>
        @endforeach                        
    </select>
    <input type="text" name="quantidade" value="{{ old('quantidade') }}" />
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <button type="submit" class="borda-preta">Cadastrar</button>
</form>