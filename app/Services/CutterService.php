<?php

namespace App\Services;

class CutterService
{
    private $cutterTable = [
        'A' => 2, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 2,
        'F' => 3, 'G' => 4, 'H' => 3, 'I' => 2, 'J' => 2,
        'K' => 2, 'L' => 3, 'M' => 4, 'N' => 3, 'O' => 2,
        'P' => 3, 'Q' => 4, 'R' => 5, 'S' => 5, 'T' => 6,
        'U' => 7, 'V' => 7, 'W' => 3, 'X' => 8, 'Y' => 2,
        'Z' => 8
    ];

    public function generateCutter(string $author, string $title): string
    {
        // Normaliza e remove espaços extras
        $author = trim($author);
        $title = trim($title);

        // Pega o último nome do autor (ex.: "Chico Buarque" → "Buarque")
        $lastName = $this->extractLastName($author);
        $firstLetter = mb_strtoupper(mb_substr($lastName, 0, 1)); // Primeira letra do último nome (ex.: "B")

        // Gera o número único baseado no último nome
        $baseNumber = $this->cutterTable[$firstLetter] ?? 2;
        $uniqueNumber = $this->generateUniqueNumber($lastName, $baseNumber);

        // Pega a primeira letra do título (ignorando artigos)
        $titleInitial = mb_strtolower($this->getTitleInitial($title));

        return sprintf('%s%d%s', $firstLetter, $uniqueNumber, $titleInitial);
    }

    private function extractLastName(string $author): string
    {
        $names = preg_split('/\s+/', $author); // Divide por espaços
        $lastName = end($names); // Pega o último nome

        // Remove partículas como "de", "da", "dos" (ex.: "Carlos Drummond de Andrade" → "Andrade")
        $ignoreParticles = ['de', 'da', 'dos', 'das', 'e'];
        while (in_array(strtolower($lastName), $ignoreParticles) && count($names) > 1) {
            array_pop($names);
            $lastName = end($names);
        }

        return $lastName;
    }

    private function generateUniqueNumber(string $lastName, int $baseNumber): int
    {
        $hash = crc32($lastName);
        $uniquePart = abs($hash) % 1000; // Número entre 0-999
        return (int) ($baseNumber . substr($uniquePart, 0, 2)); // Combina com o número base
    }

    private function getTitleInitial(string $title): string
    {
        $articles = ['A', 'O', 'AS', 'OS', 'UM', 'UMA', 'UNS', 'UMAS', 'THE'];
        $words = explode(' ', mb_strtoupper($title));
        
        foreach ($words as $word) {
            if (!in_array($word, $articles)) {
                return mb_substr($word, 0, 1);
            }
        }
        
        return mb_substr($title, 0, 1);
    }
}