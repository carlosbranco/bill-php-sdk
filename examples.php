<?php
//IMPORTAR A CLASS
use EpicBit\BillPhpSdk\Api;

// Exemplos

// Desenvolvimento
$apiClient = new Api('dev');

// Produção
$apiClient = new Api('app');

// Define o token
$apiClient->setToken('SEUTOKENAQUI');

// Verifica o token
$resposta = $apiClient->validToken();
echo json_encode($resposta) . "\n";

// Obtém todos os tipos de documento
$resposta = $apiClient->getDocumentAllTypes();
echo json_encode($resposta) . "\n";

// Lê unidades de medida
$resposta = $apiClient->getMeasurementUnits();
echo json_encode($resposta) . "\n";

// Lê métodos de pagamento
$resposta = $apiClient->getPaymentMethods();
echo json_encode($resposta) . "\n";

// Cria uma unidade de medida
$resposta = $apiClient->createMeasurementUnit(['nome' => 'Kelvin', 'simbolo' => 'K']);
echo json_encode($resposta) . "\n";

// Lê conjuntos de documentos
$resposta = $apiClient->getDocumentSets();
echo json_encode($resposta) . "\n";

// Lê impostos
$resposta = $apiClient->getTaxes();
echo json_encode($resposta) . "\n";

// Lê isenções de impostos
$resposta = $apiClient->getTaxExemptions();
echo json_encode($resposta) . "\n";

// Cria um contato
$resposta = $apiClient->createContact([
    'nome' => 'John Doe',
    'nif' => '12345789',
    'country' => 'PT'
]);
echo json_encode($resposta) . "\n";

// Cria um item
$resposta = $apiClient->createItem([
    'descricao' => 'Porta de Madeira',
    'codigo' => 'AAA1234',
    'unidade_medida_id' => 2938, // ID da unidade de medida
    'imposto_id' => 399, // ID do VAT
    'iva_compra' => 399, // ID do VAT
]);
echo json_encode($resposta) . "\n";

// Cria um documento de consumidor final
$resposta = $apiClient->createDocument([
    'tipificacao' => 'FT',
    'produtos' => [
        [
            'item_id' => 13017,
            'nome' => 'Porta de Madeira',
            'quantidade' => 1,
            'imposto' => 23,
            'preco_unitario' => 12
        ]
    ],
    'terminado' => 1 // 0 <- rascunho
]);
echo json_encode($resposta) . "\n";

// Cria uma fatura para um novo contato
$contato = [
    'nome' => 'Raul Borges',
    'pais' => 'PT',
    'nif' => '123456789'
];

$resposta = $apiClient->createDocument([
    'contato' => $contato,
    'tipificacao' => 'FT',
    'produtos' => [
        [
            'item_id' => 13017,
            'nome' => 'Porta de Madeira',
            'quantidade' => 1,
            'imposto' => 23,
            'preco_unitario' => 12
        ]
    ],
    'terminado' => 1 // 0 <- rascunho
]);
echo json_encode($resposta) . "\n";

// Cria um orçamento para um contato antigo
$resposta = $apiClient->createDocument([
    'contato_id' => 12983, // ID do contato
    'tipificacao' => 'ORC',
    'produtos' => [
        [
            'item_id' => 13017,
            'nome' => 'Porta de Madeira',
            'quantidade' => 1,
            'imposto' => 23,
            'preco_unitario' => 12
        ]
    ],
    'terminado' => 1 // 0 <- rascunho
]);
echo json_encode($resposta) . "\n";

// Cria um documento com produtos inexistentes
$resposta = $apiClient->createDocument([
    'contato_id' => 12983, // ID do contato
    'tipificacao' => 'FR',
    'produtos' => [
        [
            'codigo' => 'AAA39922', // novo produto
            'nome' => 'Janela XPTO',
            'unidade_medida_id' => 82, // ID correto
            'ProductCategory' => 'P',
            'movimenta_stock' => 1,
            'quantidade' => 1,
            'imposto' => 23,
            'preco_unitario' => 12
        ]
    ],
    'terminado' => 1 // 0 <- rascunho
]);
echo json_encode($resposta) . "\n";

// Cria um recibo para a fatura usando o ID da fatura
$resposta = $apiClient->createReceiptToDocumentWithID(2939);
echo json_encode($resposta) . "\n";

// Cria um recibo manual (parcial ou múltiplos documentos)
$resposta = $apiClient->createReceipt([
    'contato_id' => 12983, // ID do contato
    'tipo_documento_id' => 28, // recibo, 29 recibo de fornecedor
    'documentos' => [
        [
            'documento_id' => 939,
            'total' => 100, // Float (valor total do pagamento)
            'total_desconto' => 0
        ],
        [
            'documento_id' => 944,
            'total' => 89,
            'total_desconto' => 10
        ]
    ]
]);
echo json_encode($resposta) . "\n";

// Anula um documento
$resposta = $apiClient->voidDocument([
    'documento_id' => 10039,
    'motivo_anular' => 'Erro no preço.'
]);
echo json_encode($resposta) . "\n";

// Cria uma nota de crédito parcial para uma fatura
$resposta = $apiClient->createDocument([
    'contato_id' => 12983, // ID do contato
    'tipificacao' => 'NC',
    'produtos' => [
        [
            'codigo' => 'AAA39922', // novo produto
            'nome' => 'Janela XPTO',
            'unidade_medida_id' => 82, // ID correto
            'ProductCategory' => 'P',
            'movimenta_stock' => 1,
            'quantidade' => 1, // quantidade nunca poderá ser maior que o original
            'imposto' => 23,
            'preco_unitario' => 12, // preço nunca poderá ser maior que o original

            // Duas opções para fazer referência ao documento original
            // Opção 1 (escolha uma das opções)
            'referencia_manual' => 'FR BILL/3', // coloque o nome do documento original
            // Opção 2 (escolha uma das opções)
            'lancamento_pai_id' => 399, // coloque o ID da transação pai
            // Para obter a lista e o ID das transações, use a rota getDocumentWithID
        ]
    ],
    'terminado' => 1 // 0 <- rascunho
]);
echo json_encode($resposta) . "\n";

// Como criar uma nota de crédito total de uma fatura
$resposta = $apiClient->convertDocumentWithID([
    'documento_id' => 10309, // troque o ID
    'convert_to' => 'NC'
]);
echo json_encode($resposta) . "\n";

?>
