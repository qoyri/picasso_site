document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('backgroundCanvas');
    const ctx = canvas.getContext('2d');

    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    const numCircles = 10;
    const circles = [];

    for (let i = 0; i < numCircles; i++) {
        circles.push(createCircle());
    }

    function createCircle() {
        const radius = Math.random() * 100 + 50;
        const gradient = createGradient(radius);
        return {
            x: Math.random() * width,
            y: Math.random() * height,
            radius: radius,
            speedX: Math.random() * 0.5 - 0.25,
            speedY: Math.random() * 0.5 - 0.25,
            directionX: Math.random() < 0.5 ? 1 : -1,
            directionY: Math.random() < 0.5 ? 1 : -1,
            gradient: gradient
        };
    }

    function createGradient(radius) {
        const gradient = ctx.createRadialGradient(0, 0, 0, 0, 0, radius);
        gradient.addColorStop(0, 'rgba(255, 0, 128, 0.3)');
        gradient.addColorStop(0.25, 'rgba(255, 128, 0, 0.3)');
        gradient.addColorStop(0.5, 'rgba(128, 0, 255, 0.2)');
        gradient.addColorStop(0.75, 'rgba(0, 255, 255, 0.1)');
        gradient.addColorStop(1, 'rgba(255, 255, 0, 0)');
        return gradient;
    }

    function drawCircle(circle) {
        ctx.save();
        ctx.translate(circle.x, circle.y);
        ctx.beginPath();
        ctx.arc(0, 0, circle.radius, 0, 2 * Math.PI);
        ctx.fillStyle = circle.gradient;
        ctx.fill();
        ctx.restore();
    }

    function updateCircle(circle) {
        circle.x += circle.speedX * circle.directionX;
        circle.y += circle.speedY * circle.directionY;

        // Reverse direction when hitting canvas edge
        if (circle.x - circle.radius < 0 || circle.x + circle.radius > width) {
            circle.directionX *= -1;
        }
        if (circle.y - circle.radius < 0 || circle.y + circle.radius > height) {
            circle.directionY *= -1;
        }
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);
        for (const circle of circles) {
            updateCircle(circle);
            drawCircle(circle);
        }
        requestAnimationFrame(animate);
    }

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    animate();
});
