<?php

namespace Core\Domain\ValueObject;

use Core\Domain\Exception\EntityValidationException;

class CnpjCpf
{
    private string $value;
    private string $tipo;

    public function __construct(string $value)
    {
        $this->value = preg_replace('/\D/', '', $value); // Remove caracteres não numéricos
        $this->tipo = $this->setType();
    }

    private function setType(): string
    {
        return match (strlen($this->value)) {
            11 => 'CPF',
            14 => 'CNPJ',
            default => throw new EntityValidationException('Valor inválido para CPF ou CNPJ.'),
        };
    }

    public function validate(): bool
    {
        return match ($this->tipo) {
            'CPF' => $this->validationCPF(),
            'CNPJ' => $this->validionCNPJ(),
        };
    }

    private function validationCPF(): bool
    {
        // Lógica simplificada para validar CPF
        if (strlen($this->value) !== 11 || preg_match('/(\d)\1{10}/', $this->value)) {
            return false;
        }

        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $this->value[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($this->value[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    private function validionCNPJ(): bool
    {
        // Lógica simplificada para validar CNPJ
        if (strlen($this->value) !== 14 || preg_match('/(\d)\1{13}/', $this->value)) {
            return false;
        }

        $tamanhos = [5, 6];
        for ($t = 0; $t < 2; $t++) {
            $d = 0;
            $pesos = array_merge(range($tamanhos[$t], 2), range(9, 2));
            for ($c = 0; $c < count($pesos); $c++) {
                $d += $this->value[$c] * $pesos[$c];
            }
            $d = $d % 11 < 2 ? 0 : 11 - ($d % 11);
            if ($this->value[12 + $t] != $d) {
                return false;
            }
        }

        return true;
    }

    public function format(): string
    {
        return match ($this->tipo) {
            'CPF' => preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->value),
            'CNPJ' => preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->value),
        };
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
