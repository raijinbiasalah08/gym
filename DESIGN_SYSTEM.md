# GymSystem Design System

## Overview
This document outlines the design system for the Gym Management System, ensuring consistency across all pages and components.

## Color Palette

### Primary Colors
- **Brand Blue**: `#2563eb` (rgb(37, 99, 235))
  - Used for primary actions, links, and brand elements
  - Gradient: `from-blue-600 to-purple-600`

### Secondary Colors
- **Green**: `#10b981` - Success states, positive metrics
- **Yellow**: `#f59e0b` - Warnings, pending states
- **Red**: `#ef4444` - Errors, critical alerts
- **Purple**: `#8b5cf6` - Premium features, highlights
- **Indigo**: `#6366f1` - Analytics, data visualization

### Neutral Colors
- **Gray Scale**: From `#f9fafb` (50) to `#111827` (900)
- **White**: `#ffffff` with opacity variations for glassmorphism

## Typography

### Font Families
- **Headings**: Poppins (600, 700, 800)
- **Body**: Inter (300, 400, 500, 600, 700, 800)

### Font Sizes
- **Display**: 3.5rem - 4.5rem (56px - 72px)
- **H1**: 2.25rem - 3rem (36px - 48px)
- **H2**: 1.875rem - 2.25rem (30px - 36px)
- **H3**: 1.5rem - 1.875rem (24px - 30px)
- **H4**: 1.25rem - 1.5rem (20px - 24px)
- **Body**: 1rem (16px)
- **Small**: 0.875rem (14px)
- **Tiny**: 0.75rem (12px)

## Glassmorphism

### Glass Effect
```css
.glass {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.05);
}
```

### Glass Card (Primary Component Style)
```css
.glass-card {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
}

.glass-card:hover {
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.12);
}
```

## Components

### Buttons

#### Primary Button
```html
<button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
    Button Text
</button>
```

#### Secondary Button
```html
<button class="px-6 py-3 glass-card text-gray-900 font-semibold rounded-lg hover:shadow-lg transition-all duration-300">
    Button Text
</button>
```

#### Icon Button
```html
<button class="p-3 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white hover:scale-110 transition-transform shadow-lg">
    <i class="fas fa-icon"></i>
</button>
```

### Cards

#### Stat Card
```html
<div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
    <div class="p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-icon text-2xl text-white"></i>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-600 truncate">Label</dt>
                    <dd class="text-2xl font-bold text-gray-900 mt-1">Value</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
```

#### Feature Card
```html
<div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
        <i class="fas fa-icon text-2xl text-white"></i>
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-3">Title</h3>
    <p class="text-gray-600">Description text goes here</p>
</div>
```

### Badges

#### Status Badges
```html
<!-- Success -->
<span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
    Active
</span>

<!-- Warning -->
<span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
    Pending
</span>

<!-- Error -->
<span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
    Expired
</span>
```

### Forms

#### Input Field
```html
<input type="text" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
```

#### Select Dropdown
```html
<select class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
    <option>Option 1</option>
</select>
```

#### Textarea
```html
<textarea class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" rows="4"></textarea>
```

## Spacing

### Padding Scale
- `p-1`: 0.25rem (4px)
- `p-2`: 0.5rem (8px)
- `p-3`: 0.75rem (12px)
- `p-4`: 1rem (16px)
- `p-5`: 1.25rem (20px)
- `p-6`: 1.5rem (24px)
- `p-8`: 2rem (32px)
- `p-10`: 2.5rem (40px)
- `p-12`: 3rem (48px)

### Margin Scale
Same as padding scale

### Gap Scale (Grid/Flex)
- `gap-2`: 0.5rem (8px)
- `gap-4`: 1rem (16px)
- `gap-6`: 1.5rem (24px)
- `gap-8`: 2rem (32px)

## Shadows

### Elevation Levels
- **Level 1**: `shadow-sm` - Subtle elevation
- **Level 2**: `shadow` - Default elevation
- **Level 3**: `shadow-lg` - Prominent elevation
- **Level 4**: `shadow-xl` - High elevation
- **Level 5**: `shadow-2xl` - Maximum elevation

### Custom Shadows
- **Glass Shadow**: `0 8px 32px 0 rgba(31, 38, 135, 0.08)`
- **Hover Shadow**: `0 12px 40px 0 rgba(31, 38, 135, 0.12)`
- **Button Shadow**: `0 4px 15px 0 rgba(102, 126, 234, 0.3)`

## Border Radius

- **Small**: `rounded` (0.25rem / 4px)
- **Medium**: `rounded-lg` (0.5rem / 8px)
- **Large**: `rounded-xl` (0.75rem / 12px)
- **Extra Large**: `rounded-2xl` (1rem / 16px)
- **Full**: `rounded-full` (9999px)

## Animations

### Fade In
```css
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}
```

### Slide In
```css
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in {
    animation: slideIn 0.4s ease-out;
}
```

### Hover Effects
- **Lift**: `transform hover:-translate-y-1` or `hover:-translate-y-2`
- **Scale**: `hover:scale-105` or `hover:scale-110`
- **Shadow**: `hover:shadow-xl` or `hover:shadow-2xl`

## Icons

### Font Awesome Classes
We use Font Awesome 6.4.0 for all icons.

#### Common Icons
- Users: `fa-users`
- Dashboard: `fa-tachometer-alt`
- Calendar: `fa-calendar-check`
- Money: `fa-dollar-sign`, `fa-money-bill-wave`
- Chart: `fa-chart-line`, `fa-chart-bar`, `fa-chart-area`
- Settings: `fa-cog`
- User: `fa-user`, `fa-user-circle`, `fa-user-plus`
- Dumbbell: `fa-dumbbell`
- Check: `fa-check`, `fa-check-circle`
- Times: `fa-times`, `fa-times-circle`

## Responsive Breakpoints

- **sm**: 640px
- **md**: 768px
- **lg**: 1024px
- **xl**: 1280px
- **2xl**: 1536px

## Best Practices

### Do's ✅
- Use glassmorphism for cards and panels
- Apply gradient backgrounds to primary buttons and icons
- Use consistent spacing (multiples of 4px)
- Add hover effects to interactive elements
- Use semantic HTML elements
- Maintain color consistency across similar components
- Add loading states for async operations
- Use toast notifications for user feedback

### Don'ts ❌
- Don't mix different card styles on the same page
- Don't use more than 3 colors in a single component
- Don't forget to add focus states to form inputs
- Don't use inline styles (use Tailwind classes)
- Don't ignore mobile responsiveness
- Don't use animations that are too fast (<200ms) or too slow (>500ms)
- Don't forget alt text for images

## Accessibility

### Color Contrast
- Ensure text has at least 4.5:1 contrast ratio
- Use WCAG AA standards as minimum

### Focus States
- All interactive elements must have visible focus states
- Use `focus:ring-2 focus:ring-blue-500` for inputs

### Keyboard Navigation
- Ensure all functionality is accessible via keyboard
- Use proper tab order

### Screen Readers
- Use semantic HTML
- Add ARIA labels where necessary
- Provide alt text for images

## Performance

### Optimization Tips
- Use lazy loading for images
- Minimize use of backdrop-filter on mobile
- Optimize animations for 60fps
- Use CSS transforms instead of position changes
- Minimize repaints and reflows

## Version History

- **v1.0** (2025-01-22): Initial design system
  - Glassmorphism implementation
  - Color palette definition
  - Component library
  - Typography system
