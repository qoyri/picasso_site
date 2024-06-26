import { onMounted } from 'vue';
import { Application, Assets, Container, Sprite } from 'pixi.js';

onMounted(async () => {
    const app = new Application({
        view: document.querySelector('canvas'),
        backgroundColor: 0x1099bb,
        resizeTo: window
    });

    const container = new Container();
    app.stage.addChild(container);

    // Load the bunny texture
    const texture = await Assets.load('https://pixijs.com/assets/bunny.png');

    // Create a 5x5 grid of bunnies
    for (let i = 0; i < 25; i++) {
        const bunny = new Sprite(texture);

        bunny.anchor.set(0.5);
        bunny.x = (i % 5) * 40;
        bunny.y = Math.floor(i / 5) * 40;
        container.addChild(bunny);
    }

    // Move container to the center
    container.x = app.screen.width / 2;
    container.y = app.screen.height / 2;

    // Center bunny sprite in local container coordinates
    container.pivot.x = container.width / 2;
    container.pivot.y = container.height / 2;

    // Listen for animate update
    app.ticker.add((time) => {
        // Rotate the container!
        // * use delta to create frame-independent transform *
        container.rotation -= 0.01 * time.deltaTime;
    });
});