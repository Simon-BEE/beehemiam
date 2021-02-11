<?php

namespace App\ViewModels;

interface ViewModelInterface
{
    /**
     * Return prepared model to view
     *
     * @return self
     */
    public function get(): self;
}
