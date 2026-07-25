<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>John Lhester Arco | Aspiring Web Developer</title>
  <style>
    :root {
      --bg: #070b14;
      --bg-soft: #0d1320;
      --panel: rgba(18, 24, 39, 0.92);
      --panel-border: rgba(124, 166, 255, 0.16);
      --text: #e6edf7;
      --muted: #8f9bb3;
      --accent: #4f8cff;
      --accent-2: #78c6ff;
      --glow: rgba(79, 140, 255, 0.35);
      --shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      -webkit-text-size-adjust: 100%;
      background:
        radial-gradient(circle at top left, rgba(79, 140, 255, 0.18), transparent 28%),
        radial-gradient(circle at 85% 20%, rgba(120, 198, 255, 0.12), transparent 22%),
        linear-gradient(180deg, var(--bg) 0%, #090d17 58%, #06090f 100%);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image: linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
      background-size: 56px 56px;
      mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.7), transparent 90%);
      opacity: 0.35;
    }

    .site {
      position: relative;
      z-index: 1;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 24px;
      padding: 22px clamp(20px, 4vw, 48px);
      border-bottom: 1px solid rgba(124, 166, 255, 0.16);
      backdrop-filter: blur(12px);
      background: rgba(6, 9, 15, 0.78);
      position: sticky;
      top: 0;
      z-index: 10;
      overflow: visible;
    }

    .brand {
      font-size: 1.45rem;
      font-weight: 800;
      letter-spacing: 0.02em;
      color: var(--text);
      text-decoration: none;
    }

    .brand span {
      color: var(--accent);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 34px;
      flex-wrap: wrap;
    }

    .nav-links a {
      color: var(--muted);
      text-decoration: none;
      font-size: 0.98rem;
      transition: color 0.2s ease;
    }

    .nav-links a:hover {
      color: var(--text);
    }

    .resume-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 13px 18px;
      border-radius: 12px;
      background: rgba(10, 15, 26, 0.92);
      color: #eef3ff;
      font-weight: 700;
      text-decoration: none;
      box-shadow: none;
      border: 1px solid rgba(255, 255, 255, 0.9);
      cursor: pointer;
      white-space: nowrap;
    }

    .resume-btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 18px;
      height: 18px;
      flex: 0 0 18px;
      line-height: 0;
      color: currentColor;
    }

    .resume-btn-icon svg {
      width: 16px;
      height: 16px;
      display: block;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .resume-dropdown {
      position: relative;
      display: inline-flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 0;
      z-index: 20;
    }

    .resume-menu {
      display: none;
      position: absolute;
      top: calc(100% + 20px);
      right: 0;
      min-width: 174px;
      padding: 10px 8px;
      border-radius: 16px;
      border: 1px solid rgba(124, 166, 255, 0.16);
      background: rgba(14, 20, 33, 0.98);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.42);
      overflow: hidden;
    }

    .resume-dropdown.open .resume-menu {
      display: block;
    }

    .resume-option {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 12px 12px;
      border-radius: 12px;
      color: var(--text);
      text-decoration: none;
      font-size: 0.98rem;
      transition: background 0.18s ease, transform 0.18s ease;
    }

    .resume-option:hover {
      background: rgba(79, 140, 255, 0.16);
      transform: translateX(2px);
    }

    .resume-dropdown.open .resume-btn {
      box-shadow: none;
    }

    .resume-icon {
      width: 18px;
      height: 18px;
      flex: 0 0 18px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 800;
    }

    .resume-icon.pdf {
      color: #ff5f57;
      background: rgba(255, 95, 87, 0.1);
    }

    .resume-icon.image {
      color: #4f8cff;
      background: rgba(79, 140, 255, 0.1);
    }

    .resume-label {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
    }

    .hero {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      gap: 42px;
      align-items: center;
      min-height: calc(100vh - 88px);
      padding: 48px clamp(20px, 4vw, 48px) 56px;
    }

    .eyebrow {
      margin: 0 0 16px;
      color: #dce6ff;
      font-size: 1.05rem;
      letter-spacing: 0.01em;
    }

    h1 {
      margin: 0;
      font-size: clamp(3.4rem, 6vw, 6.1rem);
      line-height: 0.95;
      letter-spacing: -0.05em;
      font-weight: 900;
    }

    .accent {
      color: var(--accent);
    }

    .subtitle {
      margin: 18px 0 0;
      font-size: clamp(1.15rem, 2vw, 1.55rem);
      color: #a9b6d2;
      line-height: 1.45;
      max-width: 54rem;
    }

    .description {
      margin: 34px 0 0;
      max-width: 42rem;
      color: #8390a9;
      font-size: 1.03rem;
      line-height: 1.7;
    }

    .actions {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      margin-top: 34px;
    }

    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 166px;
      padding: 16px 24px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 800;
      border: 1px solid transparent;
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .button:hover {
      transform: translateY(-2px);
    }

    .button.primary {
      color: #07101e;
      background: linear-gradient(180deg, #5d95ff, #467ef1);
      box-shadow: 0 16px 40px rgba(70, 126, 241, 0.36), 0 0 42px var(--glow);
    }

    .button.secondary {
      color: var(--text);
      background: rgba(14, 20, 33, 0.84);
      border-color: rgba(124, 166, 255, 0.2);
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.02);
    }

    .panel {
      justify-self: end;
      width: min(100%, 640px);
      border-radius: 20px;
      border: 1px solid var(--panel-border);
      background: var(--panel);
      box-shadow: var(--shadow);
      overflow: hidden;
      backdrop-filter: blur(18px);
    }

    .panel-header {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 18px 22px;
      border-bottom: 1px solid rgba(124, 166, 255, 0.12);
      color: #95a2bf;
    }

    .dots {
      display: flex;
      gap: 8px;
      margin-right: 14px;
    }

    .dot {
      width: 12px;
      height: 12px;
      border-radius: 999px;
    }

    .dot.red { background: #ff5f57; }
    .dot.yellow { background: #febc2e; }
    .dot.green { background: #28c840; }

    .file-name {
      font-size: 0.98rem;
      letter-spacing: 0.02em;
    }

    .code {
      position: relative;
      margin: 0;
      padding: 24px 28px 30px;
      overflow: auto;
      font-family: Consolas, "Courier New", monospace;
      font-size: 1.05rem;
      line-height: 1.9;
      color: #d6deeb;
    }

    .code::after {
      content: "";
      position: absolute;
      inset: 24px auto 30px 28px;
      width: 2px;
      background: linear-gradient(180deg, transparent, #7fb0ff 20%, #7fb0ff 80%, transparent);
      box-shadow: 0 0 14px rgba(127, 176, 255, 0.8);
      animation: caretBlink 1s steps(1, end) infinite;
      pointer-events: none;
    }

    .line {
      display: grid;
      grid-template-columns: 34px 1fr;
      gap: 18px;
      white-space: pre-wrap;
      word-break: break-word;
      animation: floatLine 4.8s ease-in-out infinite;
    }

    .line:nth-child(2n) {
      animation-duration: 5.4s;
      animation-direction: reverse;
    }

    .line:nth-child(3n) {
      animation-duration: 6s;
      animation-delay: -1.5s;
    }

    .num {
      color: #55617b;
      text-align: right;
      user-select: none;
    }

    .syntax-keyword { color: #d08dff; }
    .syntax-name { color: #8ad8ff; }
    .syntax-string { color: #98f3b6; }
    .syntax-boolean { color: #ffcc70; }
    .syntax-comment { color: #6f7d98; }

    .page-section {
      padding: 88px clamp(20px, 4vw, 48px) 20px;
    }

    .section-label {
      margin: 0 0 10px;
      color: var(--accent);
      font-size: 0.95rem;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .section-title {
      margin: 0;
      font-size: clamp(2.1rem, 4vw, 3.4rem);
      line-height: 1;
      letter-spacing: -0.04em;
    }

    .about-grid {
      display: grid;
      grid-template-columns: 0.95fr 1.05fr;
      gap: 34px;
      align-items: center;
      margin-top: 34px;
    }

    .about-card {
      border: 1px solid rgba(124, 166, 255, 0.16);
      border-radius: 24px;
      overflow: hidden;
      background: rgba(14, 20, 33, 0.72);
      box-shadow: var(--shadow);
    }

    .about-card img {
      display: block;
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .about-copy {
      color: #96a4bf;
      font-size: 1.02rem;
      line-height: 1.75;
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
      margin-top: 26px;
    }

    .stat {
      padding: 14px 18px;
      border-left: 2px solid var(--accent);
      background: rgba(8, 12, 20, 0.5);
      border-radius: 14px;
    }

    .stat strong {
      display: block;
      font-size: 2rem;
      color: var(--text);
      line-height: 1;
      margin-bottom: 6px;
    }

    .stat span {
      color: #8795b0;
      font-size: 0.9rem;
    }

    .anchor-section {
      padding: 88px clamp(20px, 4vw, 48px) 0;
    }

    .section-shell {
      margin-top: 28px;
      padding: 24px;
      border: 1px solid rgba(124, 166, 255, 0.16);
      border-radius: 22px;
      background: rgba(14, 20, 33, 0.58);
      box-shadow: var(--shadow);
    }

    .skills-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .skill-card {
      min-height: 220px;
      padding: 22px 22px 18px;
      border-radius: 18px;
      background: rgba(10, 14, 23, 0.88);
      border: 1px solid rgba(124, 166, 255, 0.14);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
      color: #93a1bc;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .skill-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(47, 88, 168, 0.18);
      color: #5e91ff;
      flex: 0 0 40px;
    }

    .skill-icon svg {
      width: 21px;
      height: 21px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .skill-card h3 {
      margin: 0;
      color: var(--text);
      font-size: 1.15rem;
      line-height: 1.2;
    }

    .skill-card p {
      margin: 0;
      line-height: 1.65;
      color: #92a0ba;
    }

    .skill-tags {
      margin-top: auto;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .skill-tag {
      display: inline-flex;
      align-items: center;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(34, 58, 109, 0.72);
      color: #5e91ff;
      border: 1px solid rgba(94, 145, 255, 0.18);
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      white-space: nowrap;
    }

    .skill-card.tall {
      min-height: 220px;
    }

    .skills-heading {
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 18px;
      margin-bottom: 22px;
    }

    .skills-heading .section-title {
      font-size: clamp(2.3rem, 4.5vw, 3.8rem);
    }

    .skills-heading .section-label {
      margin-bottom: 12px;
    }

    .contact-box {
      display: grid;
      gap: 12px;
      color: #95a2bf;
    }

    .contact-heading {
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 18px;
      margin-bottom: 24px;
    }

    .contact-heading .section-title {
      font-size: clamp(2.3rem, 4.5vw, 3.8rem);
    }

    .contact-layout {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .contact-form,
    .contact-side {
      border-radius: 22px;
      border: 1px solid rgba(124, 166, 255, 0.14);
      background: rgba(10, 14, 23, 0.9);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
      padding: 22px;
    }

    .contact-form {
      display: grid;
      gap: 14px;
    }

    .contact-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 14px;
    }

    .field {
      display: grid;
      gap: 8px;
    }

    .field label {
      color: #8795b0;
      font-size: 0.92rem;
      letter-spacing: 0.02em;
    }

    .field input,
    .field textarea {
      width: 100%;
      border-radius: 12px;
      border: 1px solid rgba(124, 166, 255, 0.16);
      background: rgba(7, 11, 20, 0.85);
      color: var(--text);
      padding: 14px 16px;
      font: inherit;
      outline: none;
      transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }

    .field input::placeholder,
    .field textarea::placeholder {
      color: #55617b;
    }

    .field input:focus,
    .field textarea:focus {
      border-color: rgba(79, 140, 255, 0.65);
      box-shadow: 0 0 0 3px rgba(79, 140, 255, 0.14);
    }

    .field textarea {
      min-height: 150px;
      resize: vertical;
    }

    .field.full {
      grid-column: 1 / -1;
    }

    .send-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      border: none;
      border-radius: 14px;
      padding: 15px 18px;
      background: linear-gradient(180deg, #5d95ff, #467ef1);
      color: #07101e;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 16px 40px rgba(70, 126, 241, 0.34), 0 0 42px var(--glow);
    }

    .send-btn svg {
      width: 16px;
      height: 16px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .form-status {
      min-height: 20px;
      color: #a9b6d2;
      font-size: 0.96rem;
    }

    .contact-side {
      display: grid;
      gap: 18px;
      align-content: start;
    }

    .contact-side-item {
      display: grid;
      gap: 6px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(124, 166, 255, 0.1);
    }

    .contact-side-item:last-child {
      padding-bottom: 0;
      border-bottom: none;
    }

    .contact-side-label {
      color: #8795b0;
      font-size: 0.88rem;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .contact-side-value {
      color: var(--text);
      font-size: 1.02rem;
      word-break: break-word;
    }

    .projects-heading {
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 18px;
      margin-bottom: 24px;
    }

    .projects-heading .section-title {
      font-size: clamp(2.3rem, 4.5vw, 3.8rem);
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 18px;
    }

    .project-card {
      overflow: hidden;
      border-radius: 18px;
      background: rgba(10, 14, 23, 0.92);
      border: 1px solid rgba(124, 166, 255, 0.14);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
      display: flex;
      flex-direction: column;
      min-height: 520px;
    }

    .project-visual {
      height: 240px;
      position: relative;
      overflow: hidden;
      border-bottom: 1px solid rgba(124, 166, 255, 0.12);
      background: linear-gradient(180deg, rgba(86, 100, 132, 0.75), rgba(42, 50, 72, 0.95));
    }

    .project-visual.smart { background: linear-gradient(180deg, #59627a 0%, #354154 55%, #232a38 100%); }
    .project-visual.portfolio { background: linear-gradient(180deg, #10151f 0%, #0a0f17 100%); }
    .project-visual.cashier { background: linear-gradient(180deg, #173f1b 0%, #102b15 100%); }
    .project-visual.agrarian { background: linear-gradient(180deg, #0f5b27 0%, #0d3f1d 100%); }
    .project-visual.network { background: linear-gradient(180deg, #f8fbff 0%, #edf2f8 100%); }

    .preview-card {
      position: absolute;
      top: 22px;
      left: 50%;
      transform: translateX(-50%);
      width: 64%;
      height: 160px;
      border-radius: 12px;
      background: rgba(16, 22, 34, 0.88);
      border: 1px solid rgba(124, 166, 255, 0.12);
      box-shadow: 0 14px 32px rgba(0, 0, 0, 0.26);
      overflow: hidden;
    }

    .preview-card.left { left: 22px; transform: none; width: 38%; }
    .preview-card.right { right: 22px; left: auto; transform: none; width: 44%; }

    .preview-window {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 22px;
      background: rgba(255, 255, 255, 0.05);
    }

    .preview-window::before {
      content: "";
      position: absolute;
      left: 10px;
      top: 7px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #26d07c;
      box-shadow: 14px 0 0 #f2c14e, 28px 0 0 #4f8cff;
    }

    .preview-body {
      position: absolute;
      inset: 22px 0 0;
      padding: 10px;
      display: grid;
      gap: 10px;
    }

    .mock-title {
      margin: 0;
      color: #e8effa;
      font-size: 0.88rem;
      line-height: 1.2;
      font-weight: 700;
    }

    .mock-line { height: 8px; border-radius: 999px; background: rgba(255, 255, 255, 0.14); }
    .mock-line.short { width: 62%; }
    .mock-line.mid { width: 82%; }
    .mock-line.long { width: 100%; }

    .mock-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 8px; }
    .mock-box { height: 22px; border-radius: 6px; background: rgba(79, 140, 255, 0.25); }
    .mock-panel { height: 100%; border-radius: 10px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.06); }

    .project-content {
      padding: 20px 20px 18px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .project-title {
      margin: 0;
      color: var(--text);
      font-size: 1.45rem;
      line-height: 1.2;
      letter-spacing: -0.02em;
    }

    .project-description {
      margin: 10px 0 0;
      color: #94a0b8;
      line-height: 1.7;
      font-size: 0.98rem;
      flex: 1;
    }

    .project-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 18px;
    }

    .project-tag {
      display: inline-flex;
      align-items: center;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(34, 58, 109, 0.72);
      color: #5e91ff;
      border: 1px solid rgba(94, 145, 255, 0.18);
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      white-space: nowrap;
    }

    .project-links {
      display: flex;
      gap: 12px;
      margin-top: 16px;
    }

    .project-link {
      width: 28px;
      height: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      color: #4f8cff;
      text-decoration: none;
      background: rgba(79, 140, 255, 0.08);
      border: 1px solid rgba(79, 140, 255, 0.14);
    }

    .project-link svg {
      width: 15px;
      height: 15px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    @keyframes floatLine {
      0%, 100% {
        transform: translateX(0);
      }
      50% {
        transform: translateX(8px);
      }
    }

    @keyframes caretBlink {
      0%, 49% {
        opacity: 1;
      }
      50%, 100% {
        opacity: 0;
      }
    }

    .site-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      padding: 22px 48px;
      min-height: 96px;
      border-top: 1px solid rgba(124, 166, 255, 0.16);
      background: rgba(7, 11, 20, 0.88);
    }

    .site-footer small {
      color: #95a2bf;
      font-size: 0.92rem;
      letter-spacing: 0.02em;
    }

    .to-top {
      width: 40px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 999px;
      border: 1px solid rgba(79, 140, 255, 0.18);
      background: rgba(10, 15, 26, 0.92);
      color: #8fb2ff;
      text-decoration: none;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.03);
    }

    .to-top svg {
      width: 16px;
      height: 16px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    @media (max-width: 1080px) {
      .hero {
        grid-template-columns: 1fr;
        gap: 28px;
        min-height: auto;
      }

      .panel {
        justify-self: start;
        width: 100%;
      }

      .about-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .stats {
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      }

      .skills-heading,
      .projects-heading,
      .contact-heading {
        flex-wrap: wrap;
        align-items: flex-start;
      }

      .projects-grid {
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      }

      .contact-layout {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 720px) {
      .nav,
      .hero {
        padding-left: 20px;
        padding-right: 20px;
      }

      .nav {
        gap: 16px;
        flex-direction: column;
        align-items: flex-start;
      }

      .nav-links {
        width: 100%;
        gap: 14px 18px;
      }

      .nav-links a {
        font-size: 0.94rem;
      }

      .hero {
        min-height: auto;
        padding-top: 32px;
        padding-bottom: 42px;
      }

      .hero > * {
        min-width: 0;
      }

      .panel {
        width: 100%;
      }

      .code {
        padding: 18px 18px 24px;
        font-size: 0.92rem;
        line-height: 1.7;
      }

      .line {
        grid-template-columns: 28px 1fr;
        gap: 12px;
      }

      .subtitle,
      .description,
      .about-copy,
      .skill-card p,
      .project-description,
      .contact-side-value {
        font-size: 0.98rem;
      }

      .button {
        width: 100%;
      }

      .resume-dropdown {
        width: 100%;
        align-items: stretch;
      }

      .resume-menu {
        width: 100%;
        right: auto;
        left: 0;
      }

      .site-footer {
        padding-left: 20px;
        padding-right: 20px;
      }

      .page-section,
      .anchor-section {
        padding-left: 20px;
        padding-right: 20px;
      }

      .skills-heading,
      .projects-heading,
      .contact-heading {
        margin-bottom: 18px;
      }

      .section-shell {
        padding: 18px;
      }

      .skill-card,
      .project-card,
      .contact-form,
      .contact-side {
        border-radius: 18px;
      }

      .project-card {
        min-height: auto;
      }

      .project-visual {
        height: 210px;
      }

      .project-content {
        padding: 18px;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: clamp(2.5rem, 15vw, 3.6rem);
      }

      .hero {
        padding-top: 24px;
        padding-bottom: 34px;
      }

      .brand {
        font-size: 1.2rem;
      }

      .resume-btn {
        width: 100%;
        justify-content: center;
      }

      .actions {
        gap: 12px;
      }

      .button {
        min-width: 0;
      }

      .section-title {
        font-size: clamp(1.9rem, 9vw, 2.5rem);
      }

      .project-visual {
        height: 190px;
      }

      .site-footer {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="site">
    <header class="nav">
      <a class="brand" href="#home">&lt;<span>/</span>John&gt;</a>
      <nav class="nav-links" aria-label="Primary">
        <a href="#about">About</a>
        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
      </nav>
      <div class="resume-dropdown" id="resumeDropdown">
        <button class="resume-btn" id="resumeButton" type="button" aria-haspopup="menu" aria-expanded="false">
          <span class="resume-btn-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M12 3v11"></path>
              <path d="M8 11l4 4 4-4"></path>
              <path d="M5 19h14"></path>
            </svg>
          </span>
          <span>Resume</span>
        </button>
        <div class="resume-menu" role="menu" aria-label="Resume download options">
          <a class="resume-option" role="menuitem" href="{{ asset('img/ArcoResume.pdf') }}" download="JOHN-LHESTER-ARCO-Resume.pdf">
            <span class="resume-icon pdf">PDF</span>
            <span class="resume-label">PDF</span>
          </a>
          <a class="resume-option" role="menuitem" href="{{ asset('img/reumearco.png') }}" download="JOHN-LHESTER-ARCO-Resume.png">
            <span class="resume-icon image">IMG</span>
            <span class="resume-label">Image</span>
          </a>
        </div>
      </div>
    </header>

    <main class="hero" id="home">
      <section>
        <p class="eyebrow">Entry-Level Web Developer Opportunities</p>
        <h1>Hi, I&#39;m <span class="accent">JOHN LHESTER ARCO</span></h1>
        <p class="subtitle">Fresh Information Technology Graduate &amp; Aspiring Web Developer</p>
        <p class="description">
          I build clean, responsive websites and I am currently growing my skills in frontend and backend development.
          My focus is on creating practical, user-friendly web experiences with Laravel, CodeIgniter, WordPress, React,
          and React Native.
        </p>
        <p class="description">
          I am looking for an entry-level opportunity where I can learn, contribute, and help deliver real-world projects.
        </p>
        <div class="actions">
          <a class="button primary" href="#projects">See My Projects</a>
          <a class="button secondary" href="#contact">Let's Talk</a>
        </div>
      </section>

      <aside class="panel" aria-label="Profile code card">
        <div class="panel-header">
          <span class="dots" aria-hidden="true">
            <span class="dot red"></span>
            <span class="dot yellow"></span>
            <span class="dot green"></span>
          </span>
          <span class="file-name">about-me.js</span>
        </div>
        <pre class="code" aria-label="Profile summary code">
<span class="line"><span class="num">1</span><span><span class="syntax-keyword">const</span> <span class="syntax-name">developer</span> = {</span></span>
<span class="line"><span class="num">2</span><span>  name: <span class="syntax-string">'JOHN LHESTER ARCO'</span>,</span></span>
<span class="line"><span class="num">3</span><span>  status: <span class="syntax-string">'BS Information Technology Graduate'</span>,</span></span>
<span class="line"><span class="num">4</span><span>  based_in: <span class="syntax-string">'Philippines'</span>,</span></span>
<span class="line"><span class="num">5</span><span>  role: <span class="syntax-string">'Entry-Level Web Developer'</span>,</span></span>
<span class="line"><span class="num">6</span><span>  stack: [<span class="syntax-string">'Laravel'</span>, <span class="syntax-string">'CodeIgniter'</span>, <span class="syntax-string">'WordPress'</span>, <span class="syntax-string">'React'</span>, <span class="syntax-string">'React Native'</span>],</span></span>
<span class="line"><span class="num">7</span><span>  <span class="syntax-comment">// always learning and improving</span></span></span>
<span class="line"><span class="num">8</span><span>  experience: <span class="syntax-string">'Academic &amp; Personal Projects'</span>,</span></span>
<span class="line"><span class="num">9</span><span>  available_for_work: <span class="syntax-boolean">true</span></span></span>
<span class="line"><span class="num">10</span><span>};</span></span>
        </pre>
      </aside>
    </main>

    <section class="page-section" id="about">
      <p class="section-label">// About</p>
      <h2 class="section-title">A bit about me</h2>
      <div class="about-grid">
        <div class="about-card">
          <img src="{{ asset('img/me.jpg') }}" alt="John Lhester Arco graduation photo" />
        </div>
        <div>
          <div class="about-copy">
            <p>
              I recently graduated with a Bachelor of Science in Information Technology and I&#39;m currently looking for
              my first opportunity as an Entry-Level Web Developer. Through my academic projects, I gained experience
              building web applications using Laravel, CodeIgniter, WordPress, and MySQL, while also exploring the basics
              of React and React Native.
            </p>
            <p>
              I&#39;m passionate about learning new technologies and improving my development skills. I enjoy solving
              problems, building practical web applications, and continuously expanding my knowledge through hands-on
              projects. I&#39;m eager to learn from experienced developers and contribute positively as part of a
              professional team.
            </p>
          </div>
          <div class="stats">
            <div class="stat">
              <strong>Fresh</strong>
              <span>out of college</span>
            </div>
            <div class="stat">
              <strong>1</strong>
              <span>internships done</span>
            </div>
            <div class="stat">
              <strong>5+</strong>
              <span>personal projects</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="anchor-section" id="skills">
      <div class="skills-heading">
        <div>
          <p class="section-label">Technical Skills</p>
          <h2 class="section-title">My skill set</h2>
        </div>
      </div>
      <div class="section-shell">
        <div class="skills-grid">
          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M8 9l-4 3 4 3"/><path d="M16 9l4 3-4 3"/><path d="M10 19l4-14"/></svg>
            </div>
            <h3>Programming Languages</h3>
            <p>I&#39;ve learned PHP and JavaScript through my coursework and personal projects, and I continue to improve by building web applications.</p>
            <div class="skill-tags"><span class="skill-tag">PHP</span><span class="skill-tag">JavaScript</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 6h16v12H4z"/><path d="M4 10h16"/><path d="M8 14h3"/></svg>
            </div>
            <h3>Frontend</h3>
            <p>I create responsive web pages using HTML, CSS, and Bootstrap, and I&#39;m currently learning more about React.</p>
            <div class="skill-tags"><span class="skill-tag">HTML5</span><span class="skill-tag">CSS3</span><span class="skill-tag">Bootstrap</span><span class="skill-tag">React (Basic)</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 18h16"/><path d="M6 6h12v8H6z"/><path d="M10 18v-4"/></svg>
            </div>
            <h3>Backend</h3>
            <p>I&#39;ve worked on backend features using Laravel and CodeIgniter as part of my academic and personal projects.</p>
            <div class="skill-tags"><span class="skill-tag">Laravel</span><span class="skill-tag">CodeIgniter</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><ellipse cx="12" cy="6" rx="7" ry="3"/><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6"/><path d="M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/></svg>
            </div>
            <h3>Database</h3>
            <p>I have basic experience working with MySQL for storing and managing application data.</p>
            <div class="skill-tags"><span class="skill-tag">MySQL</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><rect x="7" y="4" width="10" height="16" rx="2"/><path d="M10 18h4"/></svg>
            </div>
            <h3>CMS &amp; Mobile</h3>
            <p>I&#39;ve built simple websites with WordPress and have started learning React Native to understand mobile application development.</p>
            <div class="skill-tags"><span class="skill-tag">WordPress</span><span class="skill-tag">React Native (Basic)</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 3v18"/><path d="M7 8h10"/><path d="M7 16h10"/><path d="M4 12h16"/></svg>
            </div>
            <h3>Tools &amp; Workflow</h3>
            <p>I&#39;m familiar with using Git, GitHub, Visual Studio Code, NetBeans, and XAMPP while working on my projects.</p>
            <div class="skill-tags"><span class="skill-tag">Git</span><span class="skill-tag">GitHub</span><span class="skill-tag">VS Code</span><span class="skill-tag">NetBeans</span><span class="skill-tag">XAMPP</span></div>
          </article>

          <article class="skill-card">
            <div class="skill-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 12h4"/><path d="M16 12h4"/><path d="M8 12a4 4 0 1 0 8 0 4 4 0 0 0-8 0z"/><path d="M9 20h6"/></svg>
            </div>
            <h3>Networking</h3>
            <p>I studied computer networking fundamentals in college and practiced designing and configuring networks using Cisco Packet Tracer.</p>
            <div class="skill-tags"><span class="skill-tag">Cisco Packet Tracer</span><span class="skill-tag">Basic Routing</span><span class="skill-tag">Switching</span></div>
          </article>
        </div>
      </div>
    </section>

    <section class="anchor-section" id="projects">
      <div class="projects-heading">
        <div>
          <p class="section-label">// Projects</p>
          <h2 class="section-title">Things I&#39;ve built</h2>
        </div>
      </div>
      <div class="section-shell">
        <div class="projects-grid">
          <article class="project-card">
            <div class="project-visual smart">
              <div class="preview-card left">
                <div class="preview-window"></div>
                <div class="preview-body">
                  <div class="mock-title">Letty&#39;s Birthing Home</div>
                  <div class="mock-line long"></div>
                  <div class="mock-line mid"></div>
                  <div class="mock-grid"><div class="mock-box"></div><div class="mock-box"></div></div>
                </div>
              </div>
            </div>
            <div class="project-content">
              <h3 class="project-title">Smart Maternal Care Management System for Letty&#39;s Birthing Home, Buhi, Camarines Sur</h3>
              <p class="project-description">A web-based maternal healthcare management system developed as our college capstone project to support patient management, appointment scheduling, inventory, and reporting for Letty&#39;s Birthing Home.</p>
              <div class="project-tags"><span class="project-tag">Laravel</span><span class="project-tag">PHP</span><span class="project-tag">MySQL</span><span class="project-tag">Bootstrap</span><span class="project-tag">JavaScript</span></div>
              <div class="project-links">
                <a class="project-link" href="#projects" aria-label="Open project link"><svg viewBox="0 0 24 24"><path d="M14 3h7v7"/><path d="M10 14L21 3"/><path d="M21 14v7h-7"/><path d="M3 10v11h11"/></svg></a>
                <a class="project-link" href="#projects" aria-label="Open GitHub link"><svg viewBox="0 0 24 24"><path d="M9 19c-4 1.5-4-2-5-2m10 4v-3.5c0-1 .3-1.6.8-2.1-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.6 1.4-3.5-.1-.3-.6-1.7.1-3.4 0 0 1.1-.3 3.5 1.4a12 12 0 0 1 6.3 0c2.4-1.7 3.5-1.4 3.5-1.4.7 1.7.2 3.1.1 3.4.9.9 1.4 2.1 1.4 3.5 0 4.8-2.9 5.9-5.7 6.2.5.5.8 1.2.8 2.4V21"/></svg></a>
              </div>
            </div>
          </article>

          <article class="project-card">
            <div class="project-visual portfolio">
              <div class="preview-card right">
                <div class="preview-window"></div>
                <div class="preview-body">
                  <div class="mock-title">Hi, I&#39;m Rudy Boringot</div>
                  <div class="mock-line long"></div>
                  <div class="mock-line mid"></div>
                  <div class="mock-panel"></div>
                </div>
              </div>
            </div>
            <div class="project-content">
              <h3 class="project-title">Personal Portfolio Website</h3>
              <p class="project-description">A personal portfolio website created to showcase my projects, technical skills, and contact information while documenting my journey as an aspiring web developer.</p>
              <div class="project-tags"><span class="project-tag">Laravel</span><span class="project-tag">HTML/CSS</span><span class="project-tag">Bootstrap</span><span class="project-tag">JavaScript</span></div>
              <div class="project-links">
                <a class="project-link" href="#projects" aria-label="Open project link"><svg viewBox="0 0 24 24"><path d="M14 3h7v7"/><path d="M10 14L21 3"/><path d="M21 14v7h-7"/><path d="M3 10v11h11"/></svg></a>
                <a class="project-link" href="https://github.com/Lhesterjohn21/Personal-Portfolio-Website" target="_blank" rel="noopener noreferrer" aria-label="Open GitHub link"><svg viewBox="0 0 24 24"><path d="M9 19c-4 1.5-4-2-5-2m10 4v-3.5c0-1 .3-1.6.8-2.1-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.6 1.4-3.5-.1-.3-.6-1.7.1-3.4 0 0 1.1-.3 3.5 1.4a12 12 0 0 1 6.3 0c2.4-1.7 3.5-1.4 3.5-1.4.7 1.7.2 3.1.1 3.4.9.9 1.4 2.1 1.4 3.5 0 4.8-2.9 5.9-5.7 6.2.5.5.8 1.2.8 2.4V21"/></svg></a>
              </div>
            </div>
          </article>

          <article class="project-card">
            <div class="project-visual cashier">
              <div class="preview-card right">
                <div class="preview-window"></div>
                <div class="preview-body">
                  <div class="mock-title">Cashier Transaction System</div>
                  <div class="mock-line long"></div>
                  <div class="mock-line short"></div>
                  <div class="mock-grid"><div class="mock-box"></div><div class="mock-box"></div></div>
                </div>
              </div>
            </div>
            <div class="project-content">
              <h3 class="project-title">Cashier Transaction Management System</h3>
              <p class="project-description">A cashier transaction management system developed during my on-the-job training to help record sales transactions, manage cashier activities, and support daily operations.</p>
              <div class="project-tags"><span class="project-tag">Laravel</span><span class="project-tag">PHP</span><span class="project-tag">MySQL</span><span class="project-tag">Bootstrap</span><span class="project-tag">JavaScript</span></div>
              <div class="project-links">
                <a class="project-link" href="#projects" aria-label="Open project link"><svg viewBox="0 0 24 24"><path d="M14 3h7v7"/><path d="M10 14L21 3"/><path d="M21 14v7h-7"/><path d="M3 10v11h11"/></svg></a>
                <a class="project-link" href="#projects" aria-label="Open GitHub link"><svg viewBox="0 0 24 24"><path d="M9 19c-4 1.5-4-2-5-2m10 4v-3.5c0-1 .3-1.6.8-2.1-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.6 1.4-3.5-.1-.3-.6-1.7.1-3.4 0 0 1.1-.3 3.5 1.4a12 12 0 0 1 6.3 0c2.4-1.7 3.5-1.4 3.5-1.4.7 1.7.2 3.1.1 3.4.9.9 1.4 2.1 1.4 3.5 0 4.8-2.9 5.9-5.7 6.2.5.5.8 1.2.8 2.4V21"/></svg></a>
              </div>
            </div>
          </article>

          <article class="project-card">
            <div class="project-visual agrarian">
              <div class="preview-card left">
                <div class="preview-window"></div>
                <div class="preview-body">
                  <div class="mock-title">Digital Agrarian Marketplace</div>
                  <div class="mock-line long"></div>
                  <div class="mock-grid"><div class="mock-box"></div><div class="mock-box"></div></div>
                  <div class="mock-line mid"></div>
                </div>
              </div>
            </div>
            <div class="project-content">
              <h3 class="project-title">The Digital Agrarian Marketplace</h3>
              <p class="project-description">A capstone-style platform designed to connect agrarian sellers and buyers through a modern web marketplace with clear product discovery and transactions.</p>
              <div class="project-tags"><span class="project-tag">PHP</span><span class="project-tag">MySQL</span><span class="project-tag">Bootstrap</span><span class="project-tag">JavaScript</span></div>
              <div class="project-links">
                <a class="project-link" href="#projects" aria-label="Open project link"><svg viewBox="0 0 24 24"><path d="M14 3h7v7"/><path d="M10 14L21 3"/><path d="M21 14v7h-7"/><path d="M3 10v11h11"/></svg></a>
                <a class="project-link" href="#projects" aria-label="Open GitHub link"><svg viewBox="0 0 24 24"><path d="M9 19c-4 1.5-4-2-5-2m10 4v-3.5c0-1 .3-1.6.8-2.1-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.6 1.4-3.5-.1-.3-.6-1.7.1-3.4 0 0 1.1-.3 3.5 1.4a12 12 0 0 1 6.3 0c2.4-1.7 3.5-1.4 3.5-1.4.7 1.7.2 3.1.1 3.4.9.9 1.4 2.1 1.4 3.5 0 4.8-2.9 5.9-5.7 6.2.5.5.8 1.2.8 2.4V21"/></svg></a>
              </div>
            </div>
          </article>

          <article class="project-card">
            <div class="project-visual network">
              <div class="preview-card right" style="background: rgba(255,255,255,0.92); border-color: rgba(55,70,100,0.12);">
                <div class="preview-window" style="background: rgba(6,18,42,0.08);"></div>
                <div class="preview-body" style="gap: 12px;">
                  <div class="mock-title" style="color:#22304c;">Network Topology Diagram</div>
                  <div class="mock-line long" style="background: rgba(34,48,76,0.16);"></div>
                  <div class="mock-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="mock-box" style="background: #4fd0e5;"></div>
                    <div class="mock-box" style="background: #ffdf70;"></div>
                    <div class="mock-box" style="background: #e6a9ff;"></div>
                  </div>
                  <div class="mock-panel" style="background: linear-gradient(135deg, rgba(74,154,255,0.14), rgba(155,86,255,0.12)); border-color: rgba(34,48,76,0.1);"></div>
                </div>
              </div>
            </div>
            <div class="project-content">
              <h3 class="project-title">Network Topology Diagram</h3>
              <p class="project-description">A networking exercise covering diagramming, basic routing, switching, and network design using Cisco Packet Tracer.</p>
              <div class="project-tags"><span class="project-tag">Cisco Packet Tracer</span><span class="project-tag">Networking</span><span class="project-tag">Topology</span></div>
              <div class="project-links">
                <a class="project-link" href="#projects" aria-label="Open project link"><svg viewBox="0 0 24 24"><path d="M14 3h7v7"/><path d="M10 14L21 3"/><path d="M21 14v7h-7"/><path d="M3 10v11h11"/></svg></a>
                <a class="project-link" href="https://github.com/Lhesterjohn21/CAMPUS-NETWORK-DESIGN" target="_blank" rel="noopener noreferrer" aria-label="Open GitHub link"><svg viewBox="0 0 24 24"><path d="M9 19c-4 1.5-4-2-5-2m10 4v-3.5c0-1 .3-1.6.8-2.1-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.6 1.4-3.5-.1-.3-.6-1.7.1-3.4 0 0 1.1-.3 3.5 1.4a12 12 0 0 1 6.3 0c2.4-1.7 3.5-1.4 3.5-1.4.7 1.7.2 3.1.1 3.4.9.9 1.4 2.1 1.4 3.5 0 4.8-2.9 5.9-5.7 6.2.5.5.8 1.2.8 2.4V21"/></svg></a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="anchor-section" id="contact">
      <div class="contact-heading">
        <div>
          <p class="section-label">// Contact</p>
          <h2 class="section-title">Give me a shot?</h2>
        </div>
      </div>
      <div class="section-shell">
        <div class="contact-layout">
          <form class="contact-form" action="send-message.php" method="post">
            <div class="contact-row">
              <div class="field">
                <label for="contactName">Name</label>
                <input id="contactName" name="name" type="text" placeholder="Your name" required />
              </div>
              <div class="field">
                <label for="contactEmail">Email</label>
                <input id="contactEmail" name="email" type="email" placeholder="Your email address" required />
              </div>
            </div>
            <div class="field full">
              <label for="contactSubject">Subject</label>
              <input id="contactSubject" name="subject" type="text" placeholder="Project inquiry" required />
            </div>
            <div class="field full">
              <label for="contactMessage">Message</label>
              <textarea id="contactMessage" name="message" placeholder="Tell me about your project..." required></textarea>
            </div>
            <div class="form-status" id="formStatus" aria-live="polite"></div>
            <button class="send-btn" type="submit">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 3L10 14"/><path d="M21 3l-7 19-4-8-8-4 19-7z"/></svg>
              Send Message
            </button>
          </form>

          <aside class="contact-side">
            <div class="contact-side-item">
              <div class="contact-side-label">Email</div>
              <div class="contact-side-value">johnlhesterarco21@gmail.com</div>
            </div>
            <div class="contact-side-item">
              <div class="contact-side-label">Location</div>
              <div class="contact-side-value">Pilli, Camarines Sur</div>
            </div>
            <div class="contact-side-item">
              <div class="contact-side-label">Phone</div>
              <div class="contact-side-value">09917972507</div>
            </div>
            <div class="contact-side-item">
              <div class="contact-side-label">Availability</div>
              <div class="contact-side-value">Open for entry-level web developer opportunities.</div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <footer class="site-footer" id="footer">
      <small>© 2026 John Lhester Arco. All rights reserved.</small>
      <a class="to-top" href="#home" aria-label="Back to top">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5"/><path d="M6 11l6-6 6 6"/></svg>
      </a>
    </footer>
  </div>

  <script>
    const resumeDropdown = document.getElementById('resumeDropdown');
    const resumeButton = document.getElementById('resumeButton');

    function closeResumeMenu() {
      resumeDropdown.classList.remove('open');
      resumeButton.setAttribute('aria-expanded', 'false');
    }

    resumeButton.addEventListener('click', () => {
      const isOpen = resumeDropdown.classList.toggle('open');
      resumeButton.setAttribute('aria-expanded', String(isOpen));
    });

    document.addEventListener('click', (event) => {
      if (!resumeDropdown.contains(event.target)) {
        closeResumeMenu();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeResumeMenu();
      }
    });

    const formStatus = document.getElementById('formStatus');
    const mailState = new URLSearchParams(window.location.search).get('mail');

    if (mailState !== null) {
      const url = new URL(window.location.href);
      url.searchParams.delete('mail');
      history.replaceState({}, '', url.pathname + url.search + url.hash);
    }

    if (mailState === 'sent') {
      formStatus.textContent = 'Message sent successfully.';
      formStatus.style.color = '#9ef0b1';
    } else if (mailState === 'failed') {
      formStatus.textContent = 'Message could not be sent. Please try again.';
      formStatus.style.color = '#ff9f9f';
    } else if (mailState === 'error') {
      formStatus.textContent = 'Please complete all fields before sending.';
      formStatus.style.color = '#ffcf8a';
    } else if (mailState === 'config') {
      formStatus.textContent = 'Mail is not configured yet. Add SMTP credentials in .env.';
      formStatus.style.color = '#ffcf8a';
    }
  </script>
</body>
</html>