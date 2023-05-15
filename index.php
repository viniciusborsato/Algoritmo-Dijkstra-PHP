<?php
// Exemplo do Algoritmo de Dijkstra, clássico do caminho mais curto usado em grafos com arestas não negativas
// vinicius@viniciusborsato.com

function dijkstra($grafico, $inicio, $final) {
  // Inicializa o array de "distâncias" e de "visitados"
  $distancias = [];
  $visitado = [];

  foreach ($grafico as $vertice => $aresta) {
    $distancias[$vertice] = INF;
    $visitado[$vertice] = false;
  }

  $distancias[$inicio] = 0;
  
  // Loop principal do código
  while ($visitado[$final] == false) {
    $minDist = INF;
    $minVert = null;
    
    // Encontra o vértice não visitado com a menor distância
    foreach ($distancias as $vertice => $distancia) {
      if ($visitado[$vertice] == false && $distancia < $minDist) {
        $minDist = $distancia;
        $minVert = $vertice;
      }
    }
    
    // Se não há mais vértices não visitados, retorna "null"
    if ($minVert === null) {
      return null;
    }
    
    // Atualiza as distâncias dos "vizinhos" do "vértice" atual
    foreach ($grafico[$minVert] as $vizinho => $distancia) {
      $alt = $distancias[$minVert] + $distancia;
      
      if ($alt < $distancias[$vizinho]) {
        $distancias[$vizinho] = $alt;
      }
    }
    
    $visitado[$minVert] = true;
  }

  // Retorna a distância mínima até o vértice de destino
  return $distancias[$final];
}

// Exemplo de uso
$grafico = [
  'A' => ['B' => 3, 'C' => 4],
  'B' => ['C' => 1, 'D' => 5],
  'C' => ['D' => 2],
  'D' => []
];

$inicio = 'A';
$fim = 'D';
$distancia = dijkstra($grafico, $inicio, $fim);

echo 'A distância mínima de "' . $inicio . '" até "' . $fim . '" é: ' . $distancia;

/*
  Neste exemplo, o grafo é representado como um array associativo em que as chaves são os vértices e os valores
  são outros arrays associativos que representam as "arestas" saindo de cada vértice e suas respectivas distâncias.
  A função dijkstra() recebe o grafo, o vértice de partida e o vértice de destino como parâmetros e retorna a distância
  mínima entre eles. O algoritmo usa um loop principal para iterar sobre os vértices não visitados com menor distância
  e atualizar as distâncias de seus vizinhos. A implementação usa o valor "INF" para representar distâncias infinitas
  e retorna "null" se não há caminho possível entre os vértices de partida e destino.
*/
?>
