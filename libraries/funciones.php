<?php

function formatearNumero(int $numero) :string {
    return number_format($numero, 2,",",".");
}