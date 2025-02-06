<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ProcessFiles
{
    /**
     * Synchronize the file uploads from the form state with the record's images.
     *
     * This method will:
     * - Delete images (and their files) that were removed from the form.
     * - Create new image records for newly uploaded files.
     */
    protected function processFiles(): void 
    {
        $data = $this->form->getState();
        $newPaths = $data['images'] ?? [];
        $existingPaths = $this->record->images->pluck('path')->toArray();
        $pathsToRemove = array_diff($existingPaths, $newPaths);
        foreach ($this->record->images as $image) {
            if (in_array($image->path, $pathsToRemove)) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
                $image->delete();
            }
        }

        $pathsToAdd = array_diff($newPaths, $existingPaths);
        foreach ($pathsToAdd as $imagePath) {
            $this->record->images()->create([
                'path' => $imagePath,
            ]);
        }
    }

    /**
     * This functiom deletes a single file using the DeleteAction 
     */

    public function deleteFile()
    {
        $images= $this->record['images'];
        foreach ($images as $image) {
            if ($image->path && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete();
        }
    }

      /**
     * Bulk delete images for an iterable of records.
     *
     * This method iterates over each record and deletes its associated images.
     *
     * @param iterable $records
     * @return void
     */
    public function bulkDeleteFiles(): void
    {
        foreach ($this->records as $record) {
            foreach ($record->images as $image) {
                if ($image->path && Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
                $image->delete();
            }
        }
    }
}
