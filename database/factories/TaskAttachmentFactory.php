<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskAttachment>
 */
class TaskAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = TaskAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileNames = [
            'design_mockup.fig',
            'requirements.pdf',
            'presentation.pptx',
            'spreadsheet.xlsx',
            'image_asset.png',
            'logo_vector.svg',
            'documentation.docx',
            'code_snippet.js',
            'database_schema.sql',
            'wireframe.png',
        ];

        $mimeTypes = [
            'application/pdf',
            'image/png',
            'image/jpeg',
            'image/svg+xml',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
            'application/javascript',
            'application/sql',
        ];

        $fileName = fake()->randomElement($fileNames);
        $size = fake()->numberBetween(1024, 10485760); // 1KB to 10MB

        return [
            'task_id' => Task::factory(),
            'user_id' => User::factory(),
            'filename' => $fileName,
            'path' => 'attachments/' . fake()->uuid() . '/' . $fileName,
            'mime_type' => fake()->randomElement($mimeTypes),
            'size' => $size,
        ];
    }
}
