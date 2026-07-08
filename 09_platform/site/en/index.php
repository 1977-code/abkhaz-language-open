<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/../inc/functions.php';
$c = cfg();
$lang = 'en';

$flash = $_SESSION['flash'] ?? null;
$old   = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);

render_head([
    'lang' => 'en',
    'title' => 'The Abkhaz Language — a modern course from zero',
    'description' => 'A modern Abkhaz language course for Russian-speaking learners: an A0–A2 textbook, native-speaker audio, a dictionary, a text corpus, and a digital platform.',
    'canonical' => $c['base_url'] . '/en/',
    'preload_hero' => true,
]);
include __DIR__ . '/../inc/header.php';
?>
    <main id="main">
      <section class="hero" id="top">
        <div class="container">
          <div class="hero-content">
            <h1>The Abkhaz Language</h1>
            <p class="hero-lead">A modern course built from zero for Russian-speaking learners: a textbook, native-speaker audio, a dictionary, a text corpus, and a digital platform.</p>
            <div class="hero-actions">
              <a class="button button-primary" href="#participate">Join the project <span aria-hidden="true">→</span></a>
              <a class="button button-secondary" href="/docs/concept-note">Concept note (in Russian)</a>
            </div>
            <p class="hero-note"><span class="pulse" aria-hidden="true"></span> The methodology, corpus foundation, and first module frameworks are ready. Course texts will appear only after native-speaker review.</p>
          </div>
        </div>
      </section>

      <div class="signal-band" aria-label="First product parameters">
        <div class="container signals">
          <div class="signal"><strong>A0–A2</strong><span>first complete route</span></div>
          <div class="signal"><strong>12</strong><span>modules planned for A0–A2</span></div>
          <div class="signal"><strong>10.8M</strong><span>open-corpus tokens</span></div>
          <div class="signal"><strong>1,500</strong><span>lemmas queued for review</span></div>
        </div>
      </div>

      <section class="section" id="product">
        <div class="container">
          <div class="section-heading">
            <div><p class="eyebrow" style="color: var(--coral)">Not just another textbook</p><h2>One integrated learning system</h2></div>
            <p>Scholarly materials on Abkhaz exist, but they are scattered and written mostly for specialists. We are building a clear path for a learner with no language environment: from the first sound to independent dialogue.</p>
          </div>
          <div class="product-grid">
            <article class="product-card"><span class="card-number">01 / Learning route</span><h3>Textbook and workbook</h3><p>A gradual A0–A2 course, then B1. Dialogues, short texts, exercises, answer keys, and a dedicated section on typical learner errors.</p></article>
            <article class="product-card"><span class="card-number">02 / Living speech</span><h3>Native-speaker audio</h3><p>Phonetics, minimal pairs, words, and dialogues at slow and natural tempo. Every recording passes a language review.</p></article>
            <article class="product-card"><span class="card-number">03 / Digital environment</span><h3>Dictionary, corpus, and website</h3><p>A frequency-based core vocabulary, verified examples, search, interactive exercises, and — later — a constrained AI tutor.</p></article>
          </div>
        </div>
      </section>

      <section class="section section-forest" id="roadmap">
        <div class="container">
          <div class="section-heading">
            <div><p class="eyebrow" style="color: #9fdcb5">Progress in the open</p><h2>What is already done</h2></div>
            <p>We do not hide the project behind promises. Methodology, rights, sources, and the production process live in open documents. The public course will appear only after review by native speakers and academic editors.</p>
          </div>
          <div class="timeline">
            <div class="timeline-row"><span class="timeline-phase">Foundation</span><strong>Source audit, rights model, and project architecture</strong><span class="status-pill status-done">Done</span></div>
            <div class="timeline-row"><span class="timeline-phase">Methodology</span><strong>A0–A2 syllabus, briefs for modules 0–4, and a pilot protocol</strong><span class="status-pill status-done">Done</span></div>
            <div class="timeline-row"><span class="timeline-phase">Corpus</span><strong>Top-5000 ABNC lemmas and a priority queue of 1,500 candidates</strong><span class="status-pill status-done">Done</span></div>
            <div class="timeline-row"><span class="timeline-phase">Expert review</span><strong>Native-speaker review, academic editing, and partner rights</strong><span class="status-pill status-next">Next</span></div>
            <div class="timeline-row"><span class="timeline-phase">Production</span><strong>Audio recording, first lessons, and a learner pilot</strong><span class="status-pill status-next">After review</span></div>
          </div>
        </div>
      </section>

      <section class="section section-white" id="participate">
        <div class="container">
          <div class="section-heading">
            <div><p class="eyebrow" style="color: var(--sea)">People we need</p><h2>Who we are looking for</h2></div>
            <p>The next step is not another document — it is a team able to verify the language and record living speech. You can start with a single consultation or one small block of work.</p>
          </div>
          <div class="roles-grid">
            <article class="role-card"><span class="role-tag">Language</span><h3>Native speakers and teachers</h3><p>Reviewing dialogues, everyday formulas, register, and naturalness. Male and female voices are needed for recording.</p><a href="#contact">Offer help →</a></article>
            <article class="role-card"><span class="role-tag">Academia</span><h3>Abkhaz scholars and methodologists</h3><p>The literary norm, phonetics, verb patterns, dialect labels, and the order of presentation for beginners.</p><a href="#contact">Become a consultant →</a></article>
            <article class="role-card"><span class="role-tag">Partnership</span><h3>Archives, media, and institutions</h3><p>We need rights-cleared texts, fragments of living speech, corpus data, pilot venues, and institutional support.</p><a href="#contact">Discuss partnership →</a></article>
          </div>
        </div>
      </section>

      <section class="section" id="documents">
        <div class="container">
          <div class="section-heading">
            <div><p class="eyebrow" style="color: var(--gold)">Working materials</p><h2>Project documents</h2></div>
            <p>Not a promo deck — the actual working base: plan, methodology, rights, and review protocols. Documents are currently in Russian.</p>
          </div>
          <div class="docs-grid">
            <a class="doc-card" href="/docs/master-plan"><div><h3>Master plan</h3><p>Stages from the audit to the B1 course and the AI layer.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/syllabus"><div><h3>A0–A2 syllabus</h3><p>Communicative goals, grammar, and assessment per chapter.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/open-data"><div><h3>Open data</h3><p>Frequency lists from three corpora: ABNC, Common Voice, Wikipedia.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
            <a class="doc-card" href="/docs/rights-registry"><div><h3>Rights registry</h3><p>Which materials can be used and on what terms.</p></div><span class="doc-arrow" aria-hidden="true">↗</span></a>
          </div>
        </div>
      </section>

      <section class="contact-band" id="contact">
        <div class="container contact-shell">
          <div>
            <h2>A language survives when people start speaking it again</h2>
            <p>If you are a native speaker, a teacher, a researcher, an institution — or simply want to help — write to us. Your message goes directly to the project initiator.</p>
            <p class="alt-mail">Or by email: <a href="mailto:<?= e($c['contact_to']) ?>"><?= e($c['contact_to']) ?></a></p>
          </div>
          <?php include __DIR__ . '/../inc/contact_form.php'; ?>
        </div>
      </section>
    </main>
<?php include __DIR__ . '/../inc/footer.php'; ?>
