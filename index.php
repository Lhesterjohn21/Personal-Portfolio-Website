<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>John Lhester Arco | Aspiring Web Developer</title>
  <link rel="icon" type="image/png" href="img/jl.png" />
  <link rel="shortcut icon" type="image/png" href="img/jl.png" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <!-- Floating Theme Switcher Widget -->
  <div class="theme-switcher-widget">
    <button class="theme-toggle-btn" id="themeToggleBtn" type="button" aria-label="Toggle Theme Color Switcher">
      <svg viewBox="0 0 24 24"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
    </button>
    <div class="theme-panel" id="themePanel">
      <div class="theme-panel-title">Theme Colors</div>
      <div class="theme-colors-list">
        <button class="theme-color-btn active" data-color="orange" aria-label="Orange Theme"></button>
        <button class="theme-color-btn" data-color="red" aria-label="Red Theme"></button>
        <button class="theme-color-btn" data-color="green" aria-label="Green Theme"></button>
        <button class="theme-color-btn" data-color="blue" aria-label="Blue Theme"></button>
        <button class="theme-color-btn" data-color="pink" aria-label="Pink Theme"></button>
      </div>
    </div>
  </div>

  <!-- Mobile Sidebar Toggle Button -->
  <button class="sidebar-toggle-btn" id="sidebarToggle" type="button" aria-label="Toggle navigation drawer">
    <svg viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
  </button>

  <div class="app-layout">

    <!-- Left Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="brand-wrapper">
        <div class="corner-bracket top-left"></div>
        <div class="corner-bracket bottom-right"></div>
        <a class="brand-logo" href="#home">&lt;<span>/</span>Lhester&gt;</a>
      </div>

      <nav class="sidebar-nav" aria-label="Primary Navigation">
        <a class="active" href="#home">
          <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
          <span>Home</span>
        </a>
        <a href="#about">
          <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
          <span>About</span>
        </a>
        <a href="#skills">
          <svg viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg>
          <span>Skills</span>
        </a>
        <a href="#projects">
          <svg viewBox="0 0 24 24"><path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/></svg>
          <span>Portfolio</span>
        </a>
        <a href="#contact">
          <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
          <span>Contact</span>
        </a>
      </nav>

      <div class="sidebar-footer">
        <div class="resume-dropdown" id="resumeDropdown">
          <button class="resume-btn" id="resumeButton" type="button" aria-haspopup="menu" aria-expanded="false">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v11"/><path d="M8 11l4 4 4-4"/><path d="M5 19h14"/></svg>
            <span>Resume</span>
          </button>
          <div class="resume-menu" role="menu">
            <a class="resume-option" href="img/ArcoResume.pdf" download="JOHN-LHESTER-ARCO-Resume.pdf">
              <span class="resume-icon pdf">PDF</span>
              <span>PDF Resume</span>
            </a>
            <a class="resume-option" href="img/reumearco.png" download="JOHN-LHESTER-ARCO-Resume.png">
              <span class="resume-icon image">IMG</span>
              <span>Image Resume</span>
            </a>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">

      <!-- Hero Section -->
      <section class="hero-atlas" id="home" data-reveal>
        <div class="hero-text-side">
          <h1 class="hero-greeting">Hello, my name is <span class="accent-name">John Lhester Arco</span></h1>
          <div class="hero-typewriter">
            I'm a <span id="typewriterText" class="accent-text">Web Developer</span><span class="cursor">|</span>
          </div>
          <p class="hero-bio">
            Fresh Information Technology Graduate &amp; Aspiring Web Developer. Motivated by a passion for creating seamless digital experiences, I build modern, responsive web applications using technologies like React, React Native, Laravel, CodeIgniter, and WordPress.
          </p>
          <a class="hero-cta" href="#about">More About Me</a>
        </div>

        <div class="profile-frame-wrapper">
          <div class="corner-bracket top-left"></div>
          <div class="corner-bracket bottom-right"></div>
          <div class="profile-frame">
            <img src="img/me.jpg" alt="John Lhester Arco" />
          </div>
        </div>
      </section>

      <hr class="section-divider" />

      <!-- About Section -->
      <section class="section-atlas" id="about" data-reveal>
        <p class="section-label">// About Me</p>
        <h2 class="section-title">Background &amp; Profile</h2>
        <div class="skill-card">
          <p style="color: var(--text-muted); line-height: 1.8; font-size: 1rem;">
            As a motivated fresh graduate, I am seeking an entry-level web development role where I can apply my full-stack foundation, adapt to industry workflows, and deliver practical solutions to meaningful projects.
          </p>
        </div>
      </section>

      <hr class="section-divider" />

      <!-- Skills Section -->
      <section class="section-atlas" id="skills" data-reveal>
        <p class="section-label">// Skills</p>
        <h2 class="section-title">Technical Expertise</h2>
        <div class="skills-grid">
          <div class="skill-card">
            <div class="skill-card-title">Frontend</div>
            <div class="skill-tags">
              <span class="skill-tag">HTML5</span>
              <span class="skill-tag">CSS3</span>
              <span class="skill-tag">JavaScript</span>
              <span class="skill-tag">React</span>
              <span class="skill-tag">Bootstrap</span>
              <span class="skill-tag">TailwindCSS</span>
            </div>
          </div>
          <div class="skill-card">
            <div class="skill-card-title">Backend</div>
            <div class="skill-tags">
              <span class="skill-tag">PHP</span>
              <span class="skill-tag">Laravel</span>
              <span class="skill-tag">CodeIgniter</span>
              <span class="skill-tag">Node.js</span>
              <span class="skill-tag">MySQL</span>
            </div>
          </div>
          <div class="skill-card">
            <div class="skill-card-title">Tools &amp; Others</div>
            <div class="skill-tags">
              <span class="skill-tag">Git</span>
              <span class="skill-tag">GitHub</span>
              <span class="skill-tag">VS Code</span>
              <span class="skill-tag">WordPress</span>
              <span class="skill-tag">XAMPP</span>
            </div>
          </div>
        </div>
      </section>

      <hr class="section-divider" />

      <!-- Portfolio Projects Section -->
      <section class="section-atlas" id="projects" data-reveal>
        <p class="section-label">// Portfolio</p>
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
          
          <article class="project-card" data-tilt data-reveal data-delay="100">
            <div class="project-visual">
              <img src="img/wams.png" alt="WAMS Screenshot" />
            </div>
            <div class="project-content">
              <h3 class="project-title">WAMS &mdash; Apartment Management System</h3>
              <p class="project-description">A comprehensive web-based apartment management system designed to simplify tenant management, lease tracking, billing, and facility administration.</p>
              <div class="project-tags">
                <span class="project-tag">Laravel</span>
                <span class="project-tag">PHP</span>
                <span class="project-tag">MySQL</span>
                <span class="project-tag">Bootstrap</span>
              </div>
              <div class="project-links">
                <a class="project-link" href="https://github.com/Lhesterjohn21/WAMS-WEB-BASED-APARTMENT-MANAGEMENT-SYSTEM-FOR-EFFICIENT-TENANT-AND-FACILITY-ADMINISTRATION" target="_blank" rel="noopener noreferrer" aria-label="GitHub Repo">
                  <svg viewBox="0 0 98 96"><path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-tilt data-reveal data-delay="200">
            <div class="project-visual">
              <img src="img/myportfolio.png" alt="Personal Portfolio Screenshot" />
            </div>
            <div class="project-content">
              <h3 class="project-title">Personal Portfolio Website</h3>
              <p class="project-description">A personal portfolio website created to showcase my projects, technical skills, and contact information while documenting my journey.</p>
              <div class="project-tags">
                <span class="project-tag">HTML/CSS</span>
                <span class="project-tag">JavaScript</span>
                <span class="project-tag">PHP</span>
              </div>
              <div class="project-links">
                <a class="project-link" href="https://github.com/Lhesterjohn21/Personal-Portfolio-Website" target="_blank" rel="noopener noreferrer" aria-label="GitHub Repo">
                  <svg viewBox="0 0 98 96"><path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-tilt data-reveal data-delay="300">
            <div class="project-visual">
              <img src="img/passaver.png" alt="PASSAVER Screenshot" />
            </div>
            <div class="project-content">
              <h3 class="project-title">PASSAVER</h3>
              <p class="project-description">PASSAVER is a browser extension that simplifies credential management by securely storing, generating, and autofilling usernames and passwords.</p>
              <div class="project-tags">
                <span class="project-tag">Extension</span>
                <span class="project-tag">JavaScript</span>
                <span class="project-tag">Security</span>
              </div>
              <div class="project-links">
                <a class="project-link" href="https://github.com/Lhesterjohn21/PASSAVER" target="_blank" rel="noopener noreferrer" aria-label="GitHub Repo">
                  <svg viewBox="0 0 98 96"><path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-tilt data-reveal data-delay="400">
            <div class="project-visual">
              <img src="img/networking.png" alt="Network Topology Diagram" />
            </div>
            <div class="project-content">
              <h3 class="project-title">Network Topology Diagram</h3>
              <p class="project-description">A networking exercise covering diagramming, basic routing, switching, and network design using Cisco Packet Tracer.</p>
              <div class="project-tags">
                <span class="project-tag">Packet Tracer</span>
                <span class="project-tag">Networking</span>
              </div>
              <div class="project-links">
                <a class="project-link" href="https://github.com/Lhesterjohn21/CAMPUS-NETWORK-DESIGN" target="_blank" rel="noopener noreferrer" aria-label="GitHub Repo">
                  <svg viewBox="0 0 98 96"><path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z"/></svg>
                </a>
              </div>
            </div>
          </article>

        </div>
      </section>

      <hr class="section-divider" />

      <!-- Contact Section -->
      <section class="section-atlas" id="contact" data-reveal>
        <p class="section-label">// Contact</p>
        <h2 class="section-title">Get In Touch</h2>

        <div class="contact-layout">
          <div class="contact-card">
            <form class="contact-form" id="contactForm" action="contact-message-handler.php" method="POST">
              <input type="hidden" name="access_key" value="ee4d1efd-f554-44ed-ab78-15cf9ea9ca41" />
              <input type="hidden" name="from_name" value="Portfolio Contact Form" />
              <input type="checkbox" name="botcheck" style="display: none;" />

              <div class="field">
                <label for="contactName">Your Name</label>
                <input id="contactName" name="name" type="text" placeholder="John Doe" required />
              </div>
              <div class="field">
                <label for="contactEmail">Your Email</label>
                <input id="contactEmail" name="email" type="email" placeholder="john@example.com" required />
              </div>
              <div class="field">
                <label for="contactSubject">Subject</label>
                <input id="contactSubject" name="subject" type="text" placeholder="Project Inquiry" required />
              </div>
              <div class="field">
                <label for="contactMessage">Message</label>
                <textarea id="contactMessage" name="message" rows="5" placeholder="Write your message..." required></textarea>
              </div>
              <button class="contact-btn" type="submit">Send Message</button>
            </form>
          </div>

          <div class="contact-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <h3 style="font-size: 1.3rem; margin-bottom: 16px; color: #ffffff;">Contact Information</h3>
              <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 24px;">
                I am currently looking for entry-level web development opportunities. Feel free to send a message or connect through social channels!
              </p>
              <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 28px;">
                <div><strong style="color: #ffffff;">Email:</strong> <a href="mailto:johnlhesterarco21@gmail.com" style="color: var(--primary); text-decoration: none;">johnlhesterarco21@gmail.com</a></div>
                <div><strong style="color: #ffffff;">Location:</strong> Pilli, Camarines Sur</div>
                <div><strong style="color: #ffffff;">Phone:</strong> 09917972507</div>
              </div>
            </div>

            <div>
              <div style="font-size: 0.88rem; font-weight: 700; color: var(--text-muted); margin-bottom: 12px; text-transform: uppercase;">Connect With Me</div>
              <div style="display: flex; gap: 10px;">
                <a class="project-link" href="https://github.com/Lhesterjohn21" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                  <svg viewBox="0 0 98 96"><path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z"/></svg>
                </a>
                <a class="project-link" href="https://www.facebook.com/lhesterjohn.21" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                  <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a class="project-link" href="https://www.instagram.com/lhester.exe/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                  <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg>
                </a>
                <a class="project-link" href="https://www.tiktok.com/@_lhesterjohn" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                  <svg viewBox="0 0 24 24"><path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743 2.895 2.895 0 0 1 3.309-4.492V9.412a6.34 6.34 0 0 0-1.636-.213 6.34 6.34 0 1 0 6.34 6.34V9.054a8.216 8.216 0 0 0 4.73 1.488V7.097a4.83 4.83 0 0 1-.327-.411z"/></svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer style="margin-top: 80px; padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.06); color: var(--text-muted); font-size: 0.88rem; text-align: center;">
        &copy; 2026 John Lhester Arco. All rights reserved.
      </footer>

    </main>
  </div>

  <div id="cursor-spotlight"></div>
  <canvas id="bg-canvas"></canvas>
  <script src="js/main.js" defer></script>
</body>

</html>