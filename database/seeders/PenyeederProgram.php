<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\JenisGelar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenyeederProgram extends Seeder
{
    public function run(): void
    {
        $daftarProgram = [
            // ===== KVT.Kom =====
            [
                'gelar' => 'KVT.Kom', 'harga' => 2500000, 'harga_coret' => 3500000,
                'unggulan' => true, 'label_badge' => '🔥 TERLARIS', 'warna_badge' => '#EF4444',
                'nama' => 'Rekayasa Perangkat Lunak Virtual',
                'deskripsi' => 'Program komprehensif rekayasa perangkat lunak: dari analisis kebutuhan, desain sistem, pengembangan full-stack, testing, hingga deployment ke cloud. Menggunakan metodologi Agile & Scrum industri.',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Pengantar Rekayasa Perangkat Lunak (3 SKS)\n• Pemrograman Python Lanjutan (3 SKS)\n• Matematika Diskrit (3 SKS)\n• Basis Data Relasional (3 SKS)\n• Komunikasi Teknis & Bahasa Inggris IT (3 SKS)\n• Praktik Linux & Terminal (3 SKS)\n\nSEMESTER 2 (18 SKS):\n• Algoritma & Struktur Data (3 SKS)\n• Pemrograman Web Backend (Laravel) (4 SKS)\n• Pemrograman Web Frontend (React) (4 SKS)\n• Basis Data Lanjutan & Query Optimization (3 SKS)\n• UI/UX Design & Figma (2 SKS)\n• Git & Version Control (2 SKS)\n\nSEMESTER 3 (18 SKS):\n• Arsitektur Perangkat Lunak & Design Pattern (3 SKS)\n• Pengembangan API RESTful & GraphQL (4 SKS)\n• Pengembangan Aplikasi Mobile (Flutter) (4 SKS)\n• Testing & Quality Assurance (3 SKS)\n• Metodologi Agile & Scrum (2 SKS)\n• Proyek Mini: Web App (2 SKS)\n\nSEMESTER 4 (18 SKS):\n• Cloud Computing AWS Fundamentals (4 SKS)\n• DevOps & CI/CD Pipeline (4 SKS)\n• Keamanan Aplikasi & OWASP (3 SKS)\n• Manajemen Proyek IT (3 SKS)\n• Microservices Architecture (2 SKS)\n• Proyek Mini: Mobile App (2 SKS)\n\nSEMESTER 5 (18 SKS):\n• Kecerdasan Buatan & Machine Learning Dasar (4 SKS)\n• Big Data & Analytics (3 SKS)\n• Pengembangan Game Dasar (Unity) (3 SKS)\n• Entrepreneurship IT (3 SKS)\n• Sertifikasi AWS/Google Prep (3 SKS)\n• Proyek Industri I (2 SKS)\n\nSEMESTER 6 (18 SKS):\n• Advanced Machine Learning & Deep Learning (4 SKS)\n• Sistem Terdistribusi (3 SKS)\n• Blockchain & Web3 Dasar (3 SKS)\n• Kepemimpinan Tim Teknis (3 SKS)\n• Proyek Industri II (Internship) (5 SKS)\n\nSEMESTER 7 (18 SKS):\n• Riset & Inovasi Teknologi (3 SKS)\n• Pengembangan Produk Digital (4 SKS)\n• Analisis Bisnis & Strategi IT (3 SKS)\n• Seminar Tugas Akhir (2 SKS)\n• Skripsi Terapan I (6 SKS)\n\nSEMESTER 8 (18 SKS):\n• Skripsi Terapan II & Sidang (12 SKS)\n• Publikasi Ilmiah (3 SKS)\n• Persiapan Karir & Portfolio (3 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Merancang arsitektur perangkat lunak skala enterprise\n✅ Memimpin tim pengembangan 5-10 orang\n✅ Membangun produk digital dari ideasi hingga deployment\n✅ Menerapkan best practice keamanan aplikasi\n✅ Lulus sertifikasi AWS/Google Cloud",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],
            [
                'gelar' => 'KVT.Kom', 'harga' => 3000000, 'harga_coret' => null,
                'unggulan' => true, 'label_badge' => '🛡️ PREMIUM', 'warna_badge' => '#7C3AED',
                'nama' => 'Keamanan Siber & Ethical Hacking',
                'deskripsi' => 'Program spesialisasi keamanan siber komprehensif: penetration testing, forensik digital, keamanan jaringan, dan incident response. Mempersiapkan lulusan untuk menjadi Cyber Security Analyst profesional.',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Jaringan Komputer & Protokol (4 SKS)\n• Sistem Operasi Linux & Windows (3 SKS)\n• Kriptografi & Keamanan Informasi (4 SKS)\n• Bahasa Pemrograman untuk Keamanan (Python) (4 SKS)\n• Hukum & Etika Siber Indonesia (3 SKS)\n\nSEMESTER 2 (18 SKS):\n• Vulnerability Assessment & Scanning (4 SKS)\n• Penetration Testing Web Application (4 SKS)\n• Forensik Digital & Analisis Bukti (4 SKS)\n• Keamanan Jaringan & Firewall (3 SKS)\n• Capture The Flag (CTF) Training (3 SKS)\n\nSEMESTER 3 (18 SKS):\n• Penetration Testing Infrastruktur (4 SKS)\n• Malware Analysis & Reverse Engineering (4 SKS)\n• Cloud Security (AWS/Azure) (4 SKS)\n• SOC & Incident Response (3 SKS)\n• Proyek: Red Team vs Blue Team (3 SKS)\n\nSEMESTER 4 (18 SKS):\n• Advanced Exploitation Techniques (4 SKS)\n• Zero-Day Research & Bug Bounty (4 SKS)\n• Security Architecture & Zero Trust (4 SKS)\n• Kepatuhan & Standar Keamanan (ISO 27001) (3 SKS)\n• Proyek Akhir Keamanan Siber (3 SKS)\n\nSEMESTER 5 (18 SKS):\n• Threat Intelligence & APT Analysis (4 SKS)\n• Keamanan IoT & Embedded Systems (3 SKS)\n• Sertifikasi CEH / CompTIA Security+ Prep (4 SKS)\n• Internship di Perusahaan Keamanan (7 SKS)\n\nSEMESTER 6-8: Skripsi & Sertifikasi Internasional (54 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Melakukan penetration testing secara etis dan legal\n✅ Menganalisis dan merespons insiden keamanan\n✅ Merancang arsitektur keamanan perusahaan\n✅ Lulus sertifikasi CEH atau CompTIA Security+",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== VT.Kom =====
            [
                'gelar' => 'VT.Kom', 'harga' => 1800000, 'harga_coret' => 2400000,
                'unggulan' => true, 'label_badge' => '⚡ POPULER', 'warna_badge' => '#F59E0B',
                'nama' => 'Pengembangan Aplikasi Web Full-Stack',
                'deskripsi' => 'Dari HTML sederhana hingga aplikasi web enterprise. Kuasai React.js, Laravel, PostgreSQL, Redis, dan deployment cloud. Langsung dapat proyek portfolio nyata.',
                'kurikulum' => "SEMESTER 1 (20 SKS):\n• HTML5, CSS3 & Responsive Design (4 SKS)\n• JavaScript Modern (ES6+) (4 SKS)\n• Git & Workflow Kolaborasi (2 SKS)\n• Basis Data SQL (MySQL/PostgreSQL) (4 SKS)\n• Pengantar Backend (PHP Dasar) (3 SKS)\n• Tools & Environment Setup (3 SKS)\n\nSEMESTER 2 (20 SKS):\n• React.js — Components & State (4 SKS)\n• Laravel Framework Lengkap (5 SKS)\n• REST API & Autentikasi JWT (4 SKS)\n• Redis & Caching Strategy (3 SKS)\n• Proyek: Aplikasi Web CRUD Penuh (4 SKS)\n\nSEMESTER 3 (20 SKS):\n• Next.js & Server-Side Rendering (4 SKS)\n• Microservices dengan Docker (4 SKS)\n• Testing (Unit, Integration, E2E) (4 SKS)\n• Deployment ke AWS / VPS (4 SKS)\n• Proyek: SaaS Mini Produk (4 SKS)\n\nSEMESTER 4 (20 SKS):\n• Advanced React & Performance (3 SKS)\n• WebSocket & Real-time Apps (3 SKS)\n• Payment Gateway Integration (3 SKS)\n• SEO & Web Performance (3 SKS)\n• Internship / Proyek Industri (8 SKS)\n\nSEMESTER 5 (20 SKS):\n• Proyek Akhir Full-Stack App (10 SKS)\n• Portfolio & Personal Branding (4 SKS)\n• Persiapan Interview Teknis (3 SKS)\n• Freelancing & Bisnis Digital (3 SKS)\n\nSEMESTER 6 (20 SKS):\n• Proyek Kolaborasi Enterprise (10 SKS)\n• Sertifikasi AWS Practitioner (5 SKS)\n• Karir & Negosiasi Gaji (2 SKS)\n• Wisuda & Presentasi Portfolio (3 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Membangun aplikasi web full-stack production-ready\n✅ Deploy dan maintain aplikasi di cloud\n✅ Integrasi payment gateway & third-party API\n✅ Membuat SaaS produk sendiri",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],
            [
                'gelar' => 'VT.Kom', 'harga' => 2000000, 'harga_coret' => null,
                'unggulan' => false, 'label_badge' => '📊 TRENDING', 'warna_badge' => '#06B6D4',
                'nama' => 'Data Science & Analitik Bisnis',
                'deskripsi' => 'Kuasai siklus lengkap data: pengumpulan, pembersihan, analisis, visualisasi, hingga machine learning. Tools: Python, Pandas, Scikit-learn, Tableau, SQL.',
                'kurikulum' => "SEMESTER 1 (20 SKS):\n• Python untuk Data Science (4 SKS)\n• Statistika & Probabilitas Dasar (4 SKS)\n• SQL & Database untuk Analis (4 SKS)\n• Excel Lanjutan & Power Query (4 SKS)\n• Pengantar Data Science (4 SKS)\n\nSEMESTER 2 (20 SKS):\n• Pandas & NumPy Mendalam (4 SKS)\n• Visualisasi Data (Matplotlib, Seaborn, Plotly) (4 SKS)\n• Machine Learning Dasar (Scikit-learn) (4 SKS)\n• Tableau & Power BI (4 SKS)\n• Proyek: Analisis Dataset Nyata (4 SKS)\n\nSEMESTER 3 (20 SKS):\n• Deep Learning dengan TensorFlow (4 SKS)\n• NLP — Pemrosesan Teks & Sentimen (4 SKS)\n• Big Data dengan Spark (3 SKS)\n• A/B Testing & Eksperimen (3 SKS)\n• Proyek: Dashboard Bisnis Interaktif (6 SKS)\n\nSEMESTER 4-6 (60 SKS): Spesialisasi + Internship + Proyek Akhir",
                'tujuan' => "Lulusan mampu:\n✅ Menganalisis dataset besar untuk keputusan bisnis\n✅ Membangun model ML untuk prediksi & klasifikasi\n✅ Membuat dashboard interaktif yang actionable\n✅ Berkomunikasi insights data ke stakeholder non-teknis",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== VTA.Kom =====
            [
                'gelar' => 'VTA.Kom', 'harga' => 1500000, 'harga_coret' => null,
                'unggulan' => false, 'label_badge' => '🏢 KORPORAT', 'warna_badge' => '#10B981',
                'nama' => 'Administrasi Sistem & Cloud Digital',
                'deskripsi' => 'Kelola infrastruktur IT perusahaan di era cloud. Microsoft Azure, Google Workspace, keamanan data, dan otomasi proses bisnis. Cocok untuk IT staff yang ingin naik level.',
                'kurikulum' => "SEMESTER 1 (22 SKS):\n• Microsoft Office 365 Suite Lengkap (4 SKS)\n• Google Workspace Admin (4 SKS)\n• Manajemen Email & Keamanan (3 SKS)\n• Jaringan Komputer Dasar (4 SKS)\n• Sistem Operasi Windows Server (4 SKS)\n• Pengantar Cloud Computing (3 SKS)\n\nSEMESTER 2 (22 SKS):\n• Microsoft Azure Fundamentals (4 SKS)\n• Database Administration MySQL (4 SKS)\n• Keamanan Informasi & Backup (4 SKS)\n• Otomasi dengan Microsoft Power Automate (3 SKS)\n• Manajemen Proyek Digital (4 SKS)\n• Proyek: Digitalisasi Proses Kantor (3 SKS)\n\nSEMESTER 3 (22 SKS):\n• Active Directory & Identity Management (4 SKS)\n• Cloud Storage & Disaster Recovery (4 SKS)\n• Compliance & Regulasi Data (GDPR/UU PDP) (3 SKS)\n• Helpdesk & IT Support Level 2 (3 SKS)\n• Proyek: Migrasi Infrastruktur ke Cloud (8 SKS)\n\nSEMESTER 4 (22 SKS):\n• Virtualisasi (VMware/Hyper-V) (4 SKS)\n• Sertifikasi Microsoft 365 Prep (5 SKS)\n• Internship IT Admin di Perusahaan (10 SKS)\n• Laporan Kerja Praktik (3 SKS)\n\nSEMESTER 5 (20 SKS):\n• Proyek Akhir: IT Infrastructure Design (10 SKS)\n• Portfolio & Presentasi (5 SKS)\n• Career Development (5 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Mengelola infrastruktur IT hybrid (on-premise + cloud)\n✅ Mengadministrasi Microsoft 365 & Google Workspace\n✅ Mengimplementasikan keamanan data perusahaan\n✅ Lulus sertifikasi Microsoft Azure Fundamentals",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== V.Com =====
            [
                'gelar' => 'V.Com', 'harga' => 1200000, 'harga_coret' => 1600000,
                'unggulan' => true, 'label_badge' => '💰 CUAN', 'warna_badge' => '#F59E0B',
                'nama' => 'Digital Marketing & E-Commerce Terapan',
                'deskripsi' => 'Dari nol hingga jago jualan online. Kuasai Shopee/Tokopedia Ads, TikTok Shop, Meta Ads, Google Ads, SEO, dan content marketing yang menghasilkan omzet nyata.',
                'kurikulum' => "SEMESTER 1 (24 SKS):\n• Dasar Bisnis Digital & E-Commerce (3 SKS)\n• Shopee & Tokopedia: Toko & Optimasi (4 SKS)\n• TikTok Shop & Konten Viral (4 SKS)\n• Copywriting & Storytelling (3 SKS)\n• Canva untuk Marketing (3 SKS)\n• Analitik Google Analytics 4 (4 SKS)\n• Keuangan Bisnis Digital Dasar (3 SKS)\n\nSEMESTER 2 (24 SKS):\n• Meta Ads (Facebook & Instagram) (5 SKS)\n• Google Ads & Search Engine Marketing (5 SKS)\n• SEO On-page & Off-page (4 SKS)\n• Email Marketing & Automation (3 SKS)\n• Influencer Marketing Strategy (3 SKS)\n• Proyek: Kampanye Iklan Nyata (4 SKS)\n\nSEMESTER 3 (24 SKS):\n• Marketplace Analytics & Reporting (4 SKS)\n• CRM & Customer Retention (3 SKS)\n• Pembuatan Website Toko (WordPress/Shopify) (4 SKS)\n• Live Commerce & Affiliate Marketing (4 SKS)\n• Hukum Bisnis Digital (2 SKS)\n• Proyek: Bisnis Digital dari Nol (7 SKS)\n\nSEMESTER 4 (24 SKS):\n• Scaling & Ekspansi Bisnis Digital (4 SKS)\n• Internship di Agency Digital / Brand (10 SKS)\n• Proyek Akhir: Pitch Business Plan (6 SKS)\n• Personal Branding & LinkedIn (4 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Mengelola toko online multi-platform dengan ROI positif\n✅ Membuat dan menjalankan kampanye iklan digital\n✅ Menganalisis data marketing untuk optimasi\n✅ Membangun bisnis digital mandiri",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],
            [
                'gelar' => 'V.Com', 'harga' => 1000000, 'harga_coret' => null,
                'unggulan' => false, 'label_badge' => '🚀 STARTUP', 'warna_badge' => '#6366F1',
                'nama' => 'Kewirausahaan Digital & Startup',
                'deskripsi' => 'Bangun startup digital dari nol: ideasi, validasi pasar, MVP, pitching investor, dan scaling. Program intensif berbasis metodologi Lean Startup dan Design Thinking.',
                'kurikulum' => "SEMESTER 1 (24 SKS):\n• Design Thinking & Problem Discovery (4 SKS)\n• Lean Startup & Business Model Canvas (4 SKS)\n• Market Research & Customer Interview (3 SKS)\n• Prototyping & MVP Development (4 SKS)\n• Keuangan Startup & Fundraising (3 SKS)\n• Hukum Startup & Legalitas (3 SKS)\n• Pitching & Public Speaking (3 SKS)\n\nSEMESTER 2 (24 SKS):\n• Product Management & Roadmap (4 SKS)\n• Growth Hacking & User Acquisition (4 SKS)\n• Unit Economics & Profitabilitas (3 SKS)\n• Manajemen Tim & Leadership (3 SKS)\n• Proyek: Launch MVP Startup (10 SKS)\n\nSEMESTER 3 (24 SKS):\n• Skalabilitas & Ekspansi Bisnis (4 SKS)\n• Investor Relations & Due Diligence (3 SKS)\n• Program Inkubasi Mini (10 SKS)\n• Mentoring Entrepreneur Senior (4 SKS)\n• Demo Day & Pitching Investor (3 SKS)\n\nSEMESTER 4 (24 SKS):\n• Franchise & Kemitraan Bisnis (3 SKS)\n• Exit Strategy & M&A Dasar (3 SKS)\n• Proyek Akhir: Startup Pitch Final (18 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Validasi ide bisnis dengan metodologi lean\n✅ Membangun dan meluncurkan MVP dalam waktu singkat\n✅ Mempresentasikan bisnis kepada investor\n✅ Mengelola pertumbuhan startup awal",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== K1 — GRATIS =====
            [
                'gelar' => 'K1', 'harga' => 0, 'harga_coret' => null,
                'unggulan' => false, 'label_badge' => '🆓 GRATIS', 'warna_badge' => '#10B981',
                'nama' => 'Literasi Digital Dasar',
                'deskripsi' => 'Program gratis untuk semua kalangan. Dari pengenalan komputer dasar, internet aman, email, hingga media sosial produktif. Mulai perjalanan digitalmu hari ini!',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Pengenalan Komputer & Perangkat Digital (3 SKS)\n• Sistem Operasi Windows 11 (3 SKS)\n• Internet & Browsing Aman (3 SKS)\n• Email Profesional (Gmail & Outlook) (3 SKS)\n• Media Sosial Positif & Produktif (2 SKS)\n• Keamanan Digital & Anti-Hoaks (2 SKS)\n• Praktik Produktivitas Harian (2 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Mengoperasikan komputer dan smartphone dengan percaya diri\n✅ Menggunakan internet secara aman dan produktif\n✅ Berkomunikasi profesional via email\n✅ Menjaga keamanan identitas digital",
                'jalur_gratis' => true,
                'syarat_gratis' => "📋 Syarat Program Gratis:\n✅ Warga Negara Indonesia\n✅ Belum pernah mengikuti program K1 sebelumnya\n✅ Mengisi formulir pendaftaran lengkap\n✅ Berkomitmen mengikuti minimal 80% sesi pembelajaran\n\n💡 Program gratis didukung oleh dana sosial Gelar.id",
            ],

            // ===== K2 =====
            [
                'gelar' => 'K2', 'harga' => 350000, 'harga_coret' => 500000,
                'unggulan' => false, 'label_badge' => '💼 KERJA', 'warna_badge' => '#F97316',
                'nama' => 'Produktivitas Digital Perkantoran',
                'deskripsi' => 'Kuasai tools produktivitas yang dipakai 90% perusahaan Indonesia. Microsoft Office 365 dan Google Workspace level profesional.',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Microsoft Word — Dokumen Profesional (3 SKS)\n• Microsoft Excel — Rumus, Pivot, Dashboard (4 SKS)\n• Microsoft PowerPoint — Presentasi Memukau (3 SKS)\n• Google Docs, Sheets & Slides (3 SKS)\n• Google Drive & Kolaborasi Cloud (2 SKS)\n• Praktik Administrasi Digital (3 SKS)\n\nSEMESTER 2 (18 SKS):\n• Excel Lanjutan — Power Query & Macro (4 SKS)\n• Google Forms & Survey Digital (2 SKS)\n• Manajemen Email & Kalender Profesional (3 SKS)\n• Zoom, Teams & Meeting Online (2 SKS)\n• Canva untuk Dokumen Kantor (2 SKS)\n• Proyek Akhir: Sistem Administrasi Digital (5 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Membuat laporan & analisis dengan Excel/Google Sheets\n✅ Mengelola dokumen dan arsip digital perusahaan\n✅ Berkolaborasi efektif dalam tim virtual",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== K3 =====
            [
                'gelar' => 'K3', 'harga' => 650000, 'harga_coret' => 900000,
                'unggulan' => false, 'label_badge' => '🎨 KREATIF', 'warna_badge' => '#EAB308',
                'nama' => 'Desain Grafis & Konten Kreatif',
                'deskripsi' => 'Jadilah desainer grafis profesional. Canva, Adobe Photoshop, Adobe Illustrator, dan desain konten media sosial yang viral.',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Prinsip Desain Visual & Teori Warna (3 SKS)\n• Canva Pro — Template & Brand Kit (3 SKS)\n• Adobe Photoshop — Editing & Retouching (4 SKS)\n• Tipografi & Layout Design (3 SKS)\n• Desain Konten Media Sosial (3 SKS)\n• Praktik: Feed Instagram Profesional (2 SKS)\n\nSEMESTER 2 (18 SKS):\n• Adobe Illustrator — Vektor & Ilustrasi (4 SKS)\n• Branding & Identitas Visual (3 SKS)\n• Motion Graphics Dasar (Adobe After Effects) (4 SKS)\n• Fotografi Produk & Editing (3 SKS)\n• Proyek: Paket Branding Lengkap (4 SKS)\n\nSEMESTER 3 (18 SKS):\n• Video Editing (Premiere Pro / CapCut Pro) (4 SKS)\n• UI Design Dasar (Figma) (3 SKS)\n• Print Design & Percetakan (2 SKS)\n• Portofolio Desain Online (Behance/Pinterest) (3 SKS)\n• Proyek Akhir: Kampanye Visual Lengkap (6 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Membuat identitas visual brand dari nol\n✅ Mengerjakan proyek desain freelance profesional\n✅ Mengelola konten visual media sosial secara konsisten",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== K4 =====
            [
                'gelar' => 'K4', 'harga' => 850000, 'harga_coret' => 1200000,
                'unggulan' => false, 'label_badge' => '🐍 PYTHON', 'warna_badge' => '#84CC16',
                'nama' => 'Pemrograman Dasar Python & Web',
                'deskripsi' => 'Mulai coding dari nol dengan Python dan Web Development dasar. Tidak perlu pengalaman sama sekali — kurikulum step-by-step dari praktisi IT aktif.',
                'kurikulum' => "SEMESTER 1 (18 SKS):\n• Logika & Algoritma Pemrograman (3 SKS)\n• Python Dasar: Sintaks, Variabel, Tipe Data (3 SKS)\n• Python Menengah: Fungsi, OOP, Modul (4 SKS)\n• Praktik Python: Automasi Sederhana (3 SKS)\n• Pengantar Git & GitHub (2 SKS)\n• Problem Solving & Computational Thinking (3 SKS)\n\nSEMESTER 2 (18 SKS):\n• HTML5 & CSS3 Modern (4 SKS)\n• JavaScript Dasar: DOM & Events (4 SKS)\n• Bootstrap & Responsive Web (3 SKS)\n• Pengantar Database SQL (3 SKS)\n• Proyek: Website Portofolio Pribadi (4 SKS)\n\nSEMESTER 3 (18 SKS):\n• Flask/Django Dasar (Backend Python) (5 SKS)\n• Python untuk Analisis Data (Pandas) (4 SKS)\n• API dan JSON: Konsumsi & Pembuatan (3 SKS)\n• Deployment ke Heroku/Railway (3 SKS)\n• Proyek Akhir: Web App Python (3 SKS)\n\nSEMESTER 4 (18 SKS):\n• Proyek Kolaborasi Tim (8 SKS)\n• Persiapan Portofolio & CV Tech (4 SKS)\n• Interview Coding Practice (3 SKS)\n• Freelancing untuk Programmer (3 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Menulis kode Python untuk otomasi dan web\n✅ Membuat website sederhana dengan HTML/CSS/JS\n✅ Membuat REST API dengan Flask/Django\n✅ Memiliki portofolio GitHub yang menarik",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== K5 =====
            [
                'gelar' => 'K5', 'harga' => 1100000, 'harga_coret' => null,
                'unggulan' => false, 'label_badge' => '📱 MOBILE', 'warna_badge' => '#06B6D4',
                'nama' => 'Pengembang Aplikasi Mobile & Backend',
                'deskripsi' => 'Jadilah developer aplikasi mobile profesional. Flutter untuk Android & iOS, backend dengan Laravel, dan publikasi ke Google Play Store.',
                'kurikulum' => "SEMESTER 1 (15 SKS):\n• Dart Programming Language (3 SKS)\n• Flutter Dasar: Widgets & Layout (4 SKS)\n• Flutter State Management (Provider/Riverpod) (4 SKS)\n• Desain UI Mobile dengan Figma (2 SKS)\n• Git & Kolaborasi Tim (2 SKS)\n\nSEMESTER 2 (15 SKS):\n• Flutter Lanjutan: Navigation & Routing (3 SKS)\n• Integrasi REST API di Flutter (4 SKS)\n• Firebase: Auth, Firestore, Storage (4 SKS)\n• Local Storage & SQLite (2 SKS)\n• Proyek: Aplikasi Mobile Pertama (2 SKS)\n\nSEMESTER 3 (15 SKS):\n• Laravel Backend untuk Mobile App (5 SKS)\n• JWT Authentication & Authorization (3 SKS)\n• Push Notification & FCM (2 SKS)\n• App Performance & Testing (3 SKS)\n• Proyek: Full-Stack Mobile App (2 SKS)\n\nSEMESTER 4 (15 SKS):\n• Google Play Store Publishing (3 SKS)\n• App Store (iOS) Dasar (2 SKS)\n• Monetisasi Aplikasi & In-App Purchase (3 SKS)\n• Proyek Akhir: Publish App di Play Store (7 SKS)\n\nSEMESTER 5 (15 SKS):\n• Advanced Flutter: Animation & Custom Widgets (5 SKS)\n• Internship / Freelance Project (10 SKS)\n\nSEMESTER 6 (15 SKS):\n• Proyek Kolaborasi Enterprise (8 SKS)\n• Portfolio & Career Preparation (7 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Membangun aplikasi Flutter untuk Android & iOS\n✅ Membuat backend API dengan Laravel\n✅ Mempublikasikan aplikasi ke Google Play Store\n✅ Mengintegrasikan Firebase dan third-party services",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],

            // ===== K6 =====
            [
                'gelar' => 'K6', 'harga' => 1400000, 'harga_coret' => 1800000,
                'unggulan' => false, 'label_badge' => '☁️ CLOUD', 'warna_badge' => '#8B5CF6',
                'nama' => 'Cloud Computing, DevOps & Arsitektur',
                'deskripsi' => 'Kuasai infrastruktur modern: AWS, GCP, Docker, Kubernetes, CI/CD, Terraform. Siap menjadi Cloud Engineer atau DevOps Engineer senior dengan gaji kompetitif.',
                'kurikulum' => "SEMESTER 1 (13-14 SKS/semester):\n• Linux Administration Lanjutan (3 SKS)\n• Networking & TCP/IP Deep Dive (3 SKS)\n• AWS Cloud Practitioner (4 SKS)\n• Shell Scripting & Automation (3 SKS)\n\nSEMESTER 2:\n• AWS Solutions Architect Associate (5 SKS)\n• Docker Fundamentals & Compose (4 SKS)\n• CI/CD dengan GitHub Actions (3 SKS)\n• Proyek: Deploy Aplikasi ke AWS (3 SKS)\n\nSEMESTER 3:\n• Kubernetes: Pods, Services, Deployments (5 SKS)\n• Google Cloud Platform (GCP) (4 SKS)\n• Monitoring (Prometheus & Grafana) (3 SKS)\n• Proyek: Multi-Cloud Architecture (3 SKS)\n\nSEMESTER 4:\n• Terraform Infrastructure as Code (4 SKS)\n• Ansible Configuration Management (3 SKS)\n• Site Reliability Engineering (SRE) (3 SKS)\n• AWS Certified Developer Prep (4 SKS)\n\nSEMESTER 5:\n• Keamanan Cloud & Compliance (4 SKS)\n• FinOps: Cloud Cost Optimization (3 SKS)\n• Internship DevOps Engineer (8 SKS)\n\nSEMESTER 6:\n• Proyek Enterprise: Microservices Migration (8 SKS)\n• Sertifikasi AWS/GCP Final Prep (5 SKS)\n\nSEMESTER 7-8:\n• Skripsi Terapan + Sertifikasi Internasional (26 SKS)",
                'tujuan' => "Lulusan mampu:\n✅ Merancang arsitektur cloud skala enterprise\n✅ Membangun pipeline CI/CD otomatis\n✅ Mengelola kluster Kubernetes di production\n✅ Lulus sertifikasi AWS Solutions Architect / GCP Associate",
                'jalur_gratis' => false, 'syarat_gratis' => null,
            ],
        ];

        foreach ($daftarProgram as $data) {
            $jenisGelar = JenisGelar::where('kode', $data['gelar'])->first();
            if (!$jenisGelar) continue;

            Program::updateOrCreate(
                ['nama' => $data['nama'], 'jenis_gelar_id' => $jenisGelar->id],
                [
                    'jenis_gelar_id' => $jenisGelar->id,
                    'nama'           => $data['nama'],
                    'slug'           => \Illuminate\Support\Str::slug($data['nama']),
                    'deskripsi'      => $data['deskripsi'],
                    'kurikulum'      => $data['kurikulum'],
                    'tujuan'         => $data['tujuan'],
                    'harga'          => $data['harga'],
                    'harga_coret'    => $data['harga_coret'],
                    'unggulan'       => $data['unggulan'],
                    'label_badge'    => $data['label_badge'] ?? null,
                    'warna_badge'    => $data['warna_badge'] ?? null,
                    'jalur_gratis'   => $data['jalur_gratis'],
                    'syarat_gratis'  => $data['syarat_gratis'],
                    'maks_peserta'   => 0,
                    'aktif'          => true,
                ]
            );
        }
    }
}
