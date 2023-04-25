<?php

//declare(strict_types=1);

class PorterStemmer
{

    public function stem($query): string
    {
        $query = strtolower($query);

        $words = explode(" ", $query);

        $correctedWords = [];

        foreach ($words as $word) {
            if (strlen($word) <= 2) {
                $correctedWords[] = $word;
            }
            else {
                $word = $this->step1a($word);
                $word = $this->step1b($word);
                $word = $this->step1c($word);
                $word = $this->step2($word);
                $word = $this->step3($word);
                $word = $this->step4($word);
                $word = $this->step5a($word);
                $word = $this->step5b($word);
                $correctedWords[] = $word;
            }

        }

        $correctedQuery = implode(" ", $correctedWords);

    
        return $correctedQuery;
    }

    private function step1a($word): string
    {
        if (substr($word, -1) === 's') {
            $this->replaceIfExists($word,"sses", "ss");
            $this->replaceIfExists($word,"ies", "i");
            $this->replaceIfExists($word,"ss", "ss");
            $this->replaceIfExists($word,"s", "");
        }

        return $word;
    }

    private function step1b($word): string
    {


        if (substr($word, -3) === 'eed') {
            if ($this->getMeasure($word) > 0) {
                $word = substr($word, 0, -1);
            }
        } else {
            if (preg_match("/(ed|ing)$/", $word)) {
                $word = preg_replace("/ed$/", "", $word);
                $word = preg_replace("/ing$/", "", $word);
                if (preg_match("/at|bl|iz/", $word)) {
                    $word .= "e";
                } elseif (preg_match("/([^aeiouylsz])\\1$/", $word)) {
                    $word = substr($word, 0, -1);
                } elseif (preg_match("/^[^aeiou][^aeiouy]*[aeiouy][^aeiouwxy]$/", $word)) {
                    $word .= "e";
                }
            }
        }

        return $word;
    }

    private function step1c($word): string
    {
        if (substr($word, -1) === 'y' && preg_match("/[aeiou]/", substr($word, 0, -1))) {
            $word = substr($word, 0, -1) . "i";
        }

        return $word;
    }

    private function step2($word): string
    {
        static $maps = [
            "ational" => "ate",
            "tional" => "tion",
            "enci" => "ence",
            "anci" => "ance",
            "izer" => "ize",
            "bli" => "ble",
            "alli" => "al",
            "entli" => "ent",
            "eli" => "e",
            "ousli" => "ous",
            "ization" => "ize",
            "ation" => "ate",
            "ator" => "ate",
            "alism" => "al",
            "iveness" => "ive",
            "fulness" => "ful",
            "ousness" => "ous",
            "aliti" => "al",
            "iviti" => "ive",
            "biliti" => "ble",
        ];

        foreach ($maps as $suffix => $replacement) {
            if ($this->endsWith($word,$suffix) && $this->getMeasure($word) > 0) {
                $word = substr($word, 0, -strlen($suffix)) . $replacement;
                break;
            }
        }

        return $word;
    }

    private function step3($word): string
    {
        static $maps = [
            "icate" => "ic",
            "ative" => "",
            "alize" => "al",
            "iciti" => "ic",
            "ical" => "ic",
            "ful" => "",
            "ness" => "",
        ];

        foreach ($maps as $suffix => $replacement) {
            if ($this->endsWith($word,$suffix) && $this->getMeasure($word) > 0) {
                $word = substr($word, 0, -strlen($suffix)) . $replacement;
                break;
            }
        }

        return $word;
    }

    private function step4($word): string
    {
        static $maps = [
            "ual" => "",
            "al" => "",
            "ance" => "",
            "ence" => "",
            "er" => "",
            "ic" => "",
            "able" => "",
            "ible" => "",
            "ant" => "",
            "ement" => "",
            "ment" => "",
            "ent" => "",
            "ou" => "",
            "ism" => "",
            "ate" => "",
            "iti" => "",
            "ous" => "",
            "ive" => "",
            "ize" => "",
            "izi" => "",
        ];

        foreach ($maps as $suffix => $replacement) {
            if ($this->endsWith($word,$suffix) && $this->getMeasure($word) > 1) {
                $word = substr($word, 0, -strlen($suffix)) . $replacement;
                break;
            }
        }

        return $word;
    }

    private function step5a($word): string
    {
        if ($this->endsWith($word,"e")) {
            if ($this->getMeasure($word) > 1) {
               
                $word = substr($word, 0, -1);
            } elseif ($this->getMeasure($word) == 1) {
                $word = substr($word, 0, -1);

                if (!$this->cvc($word,strlen($word) - 1)) {
                    $word .= "e";
                }
            }
        }

        return $word;
    }

    private function step5b($word): string
    {
        if ($this->endsWith($word,"ll") && $this->getMeasure($word) > 1) {
            $word = substr($word, 0, -1);
        }

        return $word;
    }

    private function isVowel($word,int $index): bool
    {
        static $vowels = ["a", "e", "i", "o", "u", "y"];

        return in_array($word[$index], $vowels);
    }

    private function isConsonant($word,int $index): bool
    {
        return !$this->isVowel($word,$index);
    }

    private function cvc($word,int $index): bool
    {
        if ($index < 2 || !$this->isConsonant($word,$index) || $this->isConsonant($word,$index - 1) || !$this->isConsonant($word,$index - 2)) {
            return false;
        }

        return true;
    }

    private function getMeasure($word): int
    {
        $measure = 0;
        $len = strlen($word);

        for ($i = 0; $i < $len; $i++) {
            if ($this->isVowel($word,$i)) {
                $measure++;
            }
        }

        return $measure;
    }

    private function endsWith($word,string $suffix): bool
    {
        return substr($word, -strlen($suffix)) === $suffix;
    }

    private function replaceIfExists($word,string $search, string $replace): void
    {
        $pos = strrpos($word, $search);
        if ($pos !== false) {
            $word = substr_replace($word, $replace, $pos, strlen($search));
        }
    }

}

