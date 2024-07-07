<x-app-layout>
    <hr>

    <ul>
        <li><b>Página Dashboard</b>
            <ul>
                <li><s>Acrescentar Top 5 produtos(pizza ou barra)</s></li>
                <li><s>Acrescentar Top 5 Regioes (pizza ou barra)</s></li>
                <li><s>Utilizar UF do Pedidos e não dos Contatos</s></li>
                <li><s>Dados estáticos</s>
                    <ul>
                        <li><s>Pedidos hoje</s></li>
                        <li><s>Pedidos Mês</s></li>
                        <li><s>Pedidos Ano</s></li>
                        <li><s>Pedidos Total</s></li>
                        <li><s>Revisar gráficos diário</s></li>
                        <li><s>Revisar gráficos Mensal</s></li>
                        <li><s>Revisar gráficos Anual</s></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>

    <ul>
        <li><b>Página Vendas</b>
            <ul>
                <li><s>Retirar Receita por canal de venda</s></li>
                <li><s>Acrescentar Top 5 canais de vendas (pizza / barra)</s></li>
                <li><s>Acrescentar olho no top 5 produtos</s></li>
                <li><s>Acrescentar olho no top 5 clientes</s></li>
            </ul>
        </li>
    </ul>

    <ul>
        <li><b>Página Produtos</b>
            <ul>
                <li><s>Adicionar visualização para Depósitos</s></li>
                <li><s>Adicionar visualização estoque minimo (campo qtd necessária para minimo)</s></li>
                <li><s>Adicionar visualização estoque máximo (campo qtd necessária para máximo)</s></li>
                <li><s>Alterar custo para valor de custo em etoque</s></li>
                <li><s>Alterar preco para valor de venda em etoque</s></li>
                <li><s>Relatório de Produtos com Maior Circulação(código, descricao, qtd, valor, participacao %, estoque
                        atual)</s></li>
                <li><s>Relatório de Produtos sem Movimentação(código, descricao, estoqu, data ultima venda, dias desde
                        utlima venda)</s></li>
                <li>Acrescentar o campo Dias desde a última venda</li>
                <li><s>Campo data 1ª Venda necessário? no browser</s></li>
                <li><s>Campo data Ultima Venda necessário? no browser</s></li>
            </ul>
        </li>
    </ul>

    <ul>
        <li><b>Página canais</b>
            <ul>
                <li><s>Adicionar Receita por canal de venda</s></li>
                <li><s>Campo data 1ª Venda necessário? no browser - SIM</s></li>
                <li><s>Campo data Ultima Venda necessário? no browser - SIM</s></li>
                <li><s>Acrescentar o campo Dias desde a última venda</s></li>
                <li><s>Acrescentar olho na tabela canais de venda</s></li>
                <li><s>Precisa de filtro? - NÃO</s></li>
            </ul>
        </li>
    </ul>

    <ul>
        <li><b>Clientes</b>
            <ul>
                <li><s>Remover filtro</s></li>
                <li><s>Campo data 1ª Venda necessário? no browser - NAO</s></li>
                <li><s>Campo data Ultima Venda necessário? no browser - NAO</s></li>
                <li>Acrescentar o campo Dias desde a última venda</li>
                <li><s>Alterar Tipo de Cliente Clientes compra única / Cliente recorrente</s></li>
                <li><s>Acrescentar Pessoa Fisica / Juridica (Pizza)</s></li>
                <li>Verificar tabela, está duplicando contagem de pedidos (inner join com itens)</li>
                <li>Aquisição de clientes (mensal) - Gráfico de barras com duas infos por barra</li>
                <li><s>Olho view cliente</s>
                    <ul>
                        <li><s>Mostrar dados do cliente</s></li>
                        <li><s>Mostrar pedidos do cliente</s></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>

    <ul>
        <li><b>Outros</b>
            <ul>
                <li>Mudar tabela contato para clientes</li>
                <li>Cadastrar cliente via pedido de venda</li>
                <li>Criar tabela Vendedor</li>
                <li>Cadastrar vendedor via pedido de venda (somente id)</li>
                <li>Buscar dados do vendedor via jobs</li>
                <li>alterar nome de algumas colunas ex: $pedido->transporte_etiqueta_uf</li>
                <li><s>total_prd está estático -> mudar para dinamico</s></li>
                <li>ErrorException: Trying to access array offset on value of type null in
                    D:\WORKSPACE\PHP\Laravel\dashbling\app\Services\BlingRefreshTokenService.php:64</li>
                <li>Gross Margin de vendas ((Bruto - custos) / bruto) * 100</li>
                <li>Gross Margin por produto ((Venda - custo) / venda) * 100</li>
                <li>Mostrar se está dentro da pratica de mercado (todas estasticas possíveis)</li>
                <li>Trocar Contato por Cliente e Vendedor</li>
                <li>Trocar Loja por Canal de Venda</li> 
                <li>Inclusão de try catch nos jobs</li>
                <li><s>Remover link de navegação abaixo do título</s></li>
                <li>Video divulgação
                    <ul>
                        <li>Mostrar gráficos bling</li>
                        <li>Mostrar pivot table bling</li>
                        <li>Falar sobre os gráficos do bling (preparar chamada de venda)</li>
                        <li>Mostrar Dashbling</li>
                        <li>Falar beneficios do dashbling</li>
                        <li>Fazer chamada de venda</li>
                    </ul>
                </li>
                <li><s>Verificar tamanho todos os canvas</s>
                    <ul>
                        <li><s>conforme abaixo</s></li>
                        <s>
                            < div style="position: relative; height: 300px; width: 100%;">
                                < canvas id="topEstadosChart">
                                    < /canvas>
                                        < /div>
                        </s>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</x-app-layout>
