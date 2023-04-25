<?php
class SpellChecker {
  
  private static $dictionary = ["java","work","working","not","python","trees","databases","data","structures","nation"];
  private static $ignoredWords = ["c++","C++","b+"];
  private static $stopwords = ["is","was"];

  
  public function spellCheck($query) {

    $suggestion = "";

    $query = strtolower($query);

    $words = explode(" ", $query);

    $correctedWords = [];

    foreach ($words as $word) {
      $minDistance = PHP_INT_MAX;
      if (in_array($word, self::$ignoredWords)) {
        $correctedWords[] = $word;
        continue;
      }

      if (in_array($word, self::$stopwords)) {
        $correctedWords[] = $word;
        continue;
      }
    
      foreach (self::$dictionary as $dictionaryWord) {
        $distance = $this->levenshteinDistance($word, $dictionaryWord);
        if ($distance < $minDistance) {
          $minDistance = $distance;
          $suggestion = $dictionaryWord;
        }
      }
      
      
      if ($minDistance <= floor(strlen($word) / 3)) {
        $correctedWords[] = $suggestion;
      }
      else{
        $correctedWords[] = $word;
      }
    }

    $correctedQuery = implode(" ", $correctedWords);

    
    return $correctedQuery;
  }
  
  private function levenshteinDistance($a, $b) {
    $m = strlen($a);
    $n = strlen($b);
    for ($i = 0; $i <= $m; $i++) {
      $d[$i][0] = $i; 
    }
    for ($j = 0; $j <= $n; $j++) {
      $d[0][$j] = $j;
    }
    for ($j = 1; $j <= $n; $j++) {
      for ($i = 1; $i <= $m; $i++) {
        if ($a[$i - 1] == $b[$j - 1]) {
          $cost = 0;
        } else {
          $cost = 1;
        }
        $d[$i][$j] = min($d[$i - 1][$j] + 1, $d[$i][$j - 1] + 1, $d[$i - 1][$j - 1] + $cost);
      }
    }
    return $d[$m][$n];
  }
} 
