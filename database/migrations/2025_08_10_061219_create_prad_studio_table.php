<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Services - Layanan yang ditawarkan
         */
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('icon')->nullable();
            $table->string('featured_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Technologies - Master teknologi
         */
        Schema::create('technologies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        /**
         * Projects - Portfolio proyek
         */
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->string('image_url');
            $table->string('category')->nullable();
            $table->string('client_name')->nullable();
            $table->date('project_date')->nullable();
            $table->string('project_url')->nullable();
            $table->string('case_study_url')->nullable();
            $table->string('app_store_url')->nullable();
            $table->string('play_store_url')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Project-Technology pivot
         */
        Schema::create('project_technology', function (Blueprint $table) {
            $table->uuid('project_id');
            $table->uuid('technology_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->primary(['project_id', 'technology_id']);
        });

        /**
         * Clients - Klien yang pernah bekerja sama
         */
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('industry')->nullable();
            $table->text('description')->nullable();
            $table->foreignUuid('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Testimonials - Testimoni klien
         */
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('client_name');
            $table->string('client_position')->nullable();
            $table->string('client_company')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->string('image_url')->nullable();
            $table->date('date')->nullable();
            $table->foreignUuid('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Team Members - Anggota tim
         */
        Schema::create('team_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('position');
            $table->string('department')->nullable();
            $table->text('bio')->nullable();
            $table->string('image_url')->nullable();
            $table->json('social_links')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Insights - Ringkasan portfolio/case study singkat
         */
        Schema::create('insights', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('external_link')->nullable();
            $table->foreignUuid('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Sections - Konten dinamis per bagian halaman
         */
        Schema::create('sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('page')->default('home'); // contoh: home, about, contact
            $table->string('key');                   // contoh: intro, about, showcase
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->json('extra')->nullable();       // simpan data tambahan seperti gambar/link
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Contact Submissions - Form kontak
         */
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('ip_address')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->uuid('read_by')->nullable(); // bisa FK ke users
            $table->text('response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });

        /**
         * Pages - Konten halaman statis
         */
        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('contact_submissions');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('insights');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('project_technology');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('services');
    }
};
