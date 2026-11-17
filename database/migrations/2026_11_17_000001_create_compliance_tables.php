<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compliance_records', function (Blueprint $table): void {
            $table->id();
$table->morphs('subject');
            $table->string('requirement_code');
            $table->string('name');
            $table->string('category')->nullable()->index();
            $table->longText('description')->nullable();
            $table->string('status')->default('pending')->index();
            $table->string('document_name')->nullable();
            $table->string('disk')->nullable();
            $table->text('file_path')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->date('effective_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->nullableMorphs('reviewer');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('decision_notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->unique(['subject_type', 'subject_id', 'requirement_code'], 'compliance_subject_requirement_unique');
        });

    }

    public function down(): void
    {

        Schema::dropIfExists('compliance_records');
    }
};
