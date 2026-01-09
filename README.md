# Portfolio Website

This is Obi Verheyen's portfolio website, showcasing software and game development projects.

## Live Site

The portfolio is hosted at: [https://portfolio.obi.dev/](https://portfolio.obi.dev/)

## Deployment

The site is automatically deployed to GitHub Pages via GitHub Actions when changes are pushed to the `main` branch.

### Setup Instructions

To enable GitHub Pages with the custom domain `portfolio.obi.dev`, follow these steps:

1. **Enable GitHub Pages in Repository Settings:**
   - Go to repository Settings → Pages
   - Under "Build and deployment", set Source to "GitHub Actions"

2. **Configure DNS for Custom Domain:**
   - Add the following DNS records for `portfolio.obi.dev` at your DNS provider:
     - **A records** pointing to GitHub Pages IPs:
       - `185.199.108.153`
       - `185.199.109.153`
       - `185.199.110.153`
       - `185.199.111.153`
     - **CNAME record** for `www.portfolio.obi.dev` pointing to `Shobi-one.github.io`

3. **Verify Domain in GitHub:**
   - Go to repository Settings → Pages
   - Under "Custom domain", enter `portfolio.obi.dev`
   - Wait for DNS check to complete (this may take a few minutes)
   - Enable "Enforce HTTPS" once the DNS check passes

4. **Merge PR to Main Branch:**
   - Once this PR is merged to `main`, the GitHub Actions workflow will automatically deploy the site

## Local Development

To run the site locally:

1. Clone the repository
2. Open `index.html` in a web browser, or use a local server:
   ```bash
   # Using Python 3
   python -m http.server 8000
   
   # Using Node.js (if you have http-server installed)
   npx http-server
   ```
3. Open your browser to `http://localhost:8000`

## Structure

- `index.html` - Main homepage
- `About/` - About page
- `Projects/` - Projects showcase
- `Contact/` - Contact information
- `assets/` - Images and static assets
- `styles/` - CSS stylesheets
- `scripts/` - JavaScript files
- `.github/workflows/deploy.yml` - GitHub Actions deployment workflow
- `CNAME` - Custom domain configuration

## License

© 2025 Obi Verheyen
