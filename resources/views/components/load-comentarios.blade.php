@props(['comentarios'])

<div class="w3-bar w3-container w3-margin-top">
    <hr style="height:2px;border-width:0;color:rgb(182, 182, 182);background-color:rgb(182, 182, 182)">
    <h2 class="w3-text w3-center">Comentários</h2>

    @foreach ($comentarios as $comentario)
        
    @endforeach
</table>

</div>