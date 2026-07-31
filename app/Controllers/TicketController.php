<?php
declare(strict_types=1);

namespace DevLab\Controllers;

use DevLab\Models\TicketModel;

final class TicketController
{
    public function load(): array
    {
        return TicketModel::load();
    }
}


