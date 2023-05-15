<?php
function dijkstra($grafico, $inicio, $final)
{
  $distancias = [];
  $visitado = [];

  foreach ($grafico as $vertice => $aresta) {
    $distancias[$vertice] = INF;
    $visitado[$vertice] = false;
  }

  $distancias[$inicio] = 0;
  
  while ($visitado[$final] == false) {
    $minDist = INF;
    $minVert = null;
    
    foreach ($distancias as $vertice => $distancia)
    {
      if ($visitado[$vertice] == false && $distancia < $minDist) {
        $minDist = $distancia;
        $minVert = $vertice;
      }
    }
    
    if ($minVert === null) {
      return null;
    }
    
    foreach ($grafico[$minVert] as $vizinho => $distancia) {
      $alt = $distancias[$minVert] + $distancia;
      if ($alt < $distancias[$vizinho]) {
        $distancias[$vizinho] = $alt;
      }
    }
    
    $visitado[$minVert] = true;
  }
  return $distancias[$final];
}

$grafico = ['A' => ['B' => 3, 'C' => 4], 'B' => ['C' => 1, 'D' => 5], 'C' => ['D' => 2], 'D' => []];

$inicio = 'A';

$fim = 'D';

$distancia = dijkstra($grafico, $inicio, $fim);

  echo 'A distância mínima de "' . $inicio . '" até "' . $fim . '" é: ' . $distancia;
?>
