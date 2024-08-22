<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileToExcelController extends Controller
{
    public $current_key = null;
    public $current_value = null;
    public $last_key_empty = null;

    public function parse()
    {
        $read_lines = [];
        // return trim('"ho " can this be true"', '"');

        $file = fopen(public_path('en.js'), 'r');
        // specify the take position
        $start_taking = false;
        $start_at = 'A1421';
        $index = 0;
        while (!feof($file)) {
            $index++;

            $read_line = trim(fgets($file));
            // 
            if (!$start_taking && str_contains($read_line, $start_at)) {
                $start_taking = true;
            };
            // start building up the array when start taking position is reached
            if (!$start_taking) continue;
            // filter out lines with {} or empty lines
            if (str_contains($read_line, '{') || str_contains($read_line, '}') || empty($read_line)) {
                // Log::info($read_line);
                continue;
            }
            $has_empty_key = $this->has_empty_key($read_line);
            if (!$has_empty_key) {
                if ($this->last_key_empty) {
                    $read_lines[] = ['key' => $this->last_key_empty, 'value' => trim($this->current_key, '"')];
                    $this->last_key_empty = null;
                } else {
                    $read_lines[] = ['key' => $this->current_key, 'value' => trim($this->current_value, '"')];
                }
            } else {
                $this->last_key_empty = $this->current_key;
            }
        }
        // return $read_lines;
        return (new Collection($read_lines))->downloadExcel('my-excel.xlsx');
    }

    public function transform_to_array(): array | string
    {

        return [
            'key' => $this->current_key,
            'value' => trim($this->current_value, '"'),
            // 'value' => str_replace('"', '', trim($read_line_arr[1] ?? '')),
        ];
    }

    // has_empty_key
    public function has_empty_key(string $read_line)
    {
        if ($this->last_key_empty) {
            $this->current_key = $read_line;
            return false;
        }
        $read_line_arr = explode(':', $read_line, 2);
        $this->current_key = $read_line_arr[0];
        $this->current_value = trim($read_line_arr[1] ?? '', ' ,');
        // if there is key and it is empty, don't proceed
        return ((str_starts_with($this->current_key, 'A') && is_numeric($this->current_key[1])) || str_ends_with($this->current_key, '?'))
            && empty($this->current_value);
    }
}
