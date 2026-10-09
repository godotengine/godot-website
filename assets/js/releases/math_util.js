// Source - https://stackoverflow.com/a
// Posted by Alnitak, modified by community. See post 'Timeline' for change history
// Retrieved 2026-01-20, License - CC BY-SA 3.0

export function mapRange(value, low1, high1, low2, high2) {
    return low2 + (high2 - low2) * (value - low1) / (high1 - low1);
}

export function clamp(number, min, max) {
    return Math.max(min, Math.min(number, max));
}