# Contributing to TitansGym Management System

First off, thank you for considering contributing to TitansGym! It's people like you that make this project better for everyone.

## 🤝 How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples** to demonstrate the steps
- **Describe the behavior you observed** and what you expected
- **Include screenshots** if possible
- **Include your environment details** (OS, PHP version, Laravel version, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, include:

- **Use a clear and descriptive title**
- **Provide a detailed description** of the suggested enhancement
- **Explain why this enhancement would be useful**
- **List any alternative solutions** you've considered

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Follow the coding standards** used throughout the project
3. **Write clear, descriptive commit messages**
4. **Update documentation** if you're changing functionality
5. **Test your changes** thoroughly
6. **Ensure your code follows PSR-12** coding standards

## 🔧 Development Setup

1. Fork and clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy `.env.example` to `.env` and configure your database
4. Run migrations:
   ```bash
   php artisan migrate --seed
   ```
5. Build assets:
   ```bash
   npm run dev
   ```

## 📝 Coding Standards

### PHP
- Follow **PSR-12** coding standards
- Use **type hints** where possible
- Write **PHPDoc comments** for classes and methods
- Keep methods **small and focused**

### JavaScript
- Use **ES6+** syntax
- Follow **consistent naming conventions**
- Add comments for complex logic

### Blade Templates
- Use **semantic HTML**
- Follow **TailwindCSS** utility-first approach
- Maintain **glassmorphism design** consistency
- Ensure **responsive design**

### Database
- Write **clear migration** files
- Use **descriptive column names**
- Add **foreign key constraints** where appropriate
- Include **indexes** for frequently queried columns

## 🧪 Testing

Before submitting a pull request:

1. Test all affected features manually
2. Ensure no console errors in browser
3. Test on different screen sizes
4. Verify database migrations work correctly
5. Check for any breaking changes

## 📋 Commit Message Guidelines

Use clear and meaningful commit messages:

```
feat: Add trainer performance chart to dashboard
fix: Resolve booking date validation issue
docs: Update installation instructions
style: Apply glassmorphism to member dashboard
refactor: Optimize database queries in reports
test: Add unit tests for payment controller
```

### Commit Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, etc.)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

## 🎨 Design Guidelines

When contributing UI changes:

1. **Maintain glassmorphism aesthetic**
   - Use `glass-card` classes
   - Apply gradient backgrounds for icons
   - Include hover effects and transitions

2. **Follow color palette**
   - Blue gradients: `from-blue-500 to-blue-600`
   - Green gradients: `from-green-500 to-green-600`
   - Purple gradients: `from-purple-500 to-purple-600`
   - Yellow gradients: `from-yellow-500 to-yellow-600`

3. **Ensure accessibility**
   - Maintain color contrast ratios
   - Add ARIA labels where needed
   - Support keyboard navigation

4. **Keep it responsive**
   - Test on mobile, tablet, and desktop
   - Use TailwindCSS responsive utilities
   - Ensure touch-friendly button sizes (min 44px)

## 📚 Documentation

- Update README.md for new features
- Add inline comments for complex logic
- Update API documentation if applicable
- Include examples in documentation

## 🚫 What NOT to Do

- Don't commit directly to `main` branch
- Don't include unrelated changes in your PR
- Don't commit sensitive information (API keys, passwords)
- Don't ignore linting errors
- Don't submit untested code

## 📞 Getting Help

If you need help:

1. Check existing documentation
2. Search closed issues
3. Ask in the issue comments
4. Create a new issue with the `question` label

## 🎉 Recognition

Contributors will be recognized in:
- The project README
- Release notes
- GitHub contributors page

Thank you for contributing to TitansGym Management System! 💪
