<?php

namespace App\Repository\Header;

interface HeaderRepository{
    public function getCategories();
    public function getGenres();
    public function getCountries();
}