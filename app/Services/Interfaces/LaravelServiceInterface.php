<?php

namespace App\Services\Interfaces;

interface LaravelServiceInterface
{
    public function index();

    public function store();

    public function show($id);

    public function update($id);

    public function delete($id);
}
