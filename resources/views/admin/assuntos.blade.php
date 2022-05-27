<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row">
            <div class="w3-container w3-twothird">
                <h2>Assuntos</h2>
            </div>
            <div class="w3-right-align w3-margin-top w3-container w3-third">
                <form>
                    <button formaction="/admin/analitica/assuntos/adicionar" class="w3-btn w3-green w3-round">Adicionar Assunto</button>
                </form>
            </div>
        </div>
    </div>

    <table class="w3-table-all w3-hoverable">
        <tr class="w3-theme">
            <th>ID</th>
            <th>Natureza do Assunto</th>
            <th>Descrição do Assunto</th>
            <th>Alterar Assunto</th>
        </tr>
    </table>

    <div class="w3-section">
        {{-- {{ $users->links() }} --}}
    </div>
</x-layout>