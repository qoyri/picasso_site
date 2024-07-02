<!DOCTYPE html>
<html>
<head>
    <title>Texte 3D brouillard Three.js</title>
    <style>
        body { margin: 0; }
        canvas { width: 100%; height: 100% }
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    let scene, camera, renderer, textMesh;

    const initialRotationX = -55.70 * (Math.PI / 180);
    const initialRotationY = 1.86 * (Math.PI / 180);
    const initialRotationZ = 26.73 * (Math.PI / 180);
    let targetRotationX = initialRotationX;
    let targetRotationY = initialRotationY;
    let targetRotationZ = initialRotationZ;
    const rotationSpeed = 0.1;

    init();
    animate();

    function init() {
        // Setup de la scène, de la caméra et du renderer
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        camera.position.set(0, 2, 5);
        renderer = new THREE.WebGLRenderer({antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);
        renderer.shadowMap.enabled = true;
        //renderer.setClearColor(0x808080)  //couleur de fond personnaliser


        scene.fog = new THREE.FogExp2(0x000000, 0.08);
        renderer.setClearColor(scene.fog.color);



        // Ajout de la lumière
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
        ambientLight .position.set(0, 2, 0);
        scene.add(ambientLight);
        const pointLight = new THREE.PointLight(0xffffff, 0.5);
        pointLight .position.set(0, 2, 0);
        camera.add(pointLight);
        scene.add(camera);

        const loader = new THREE.FontLoader();
        loader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', function (font) {
            const textGeometry = new THREE.TextGeometry('Gradient', {
                font: font,
                size: 2,
                height: 1,
                curveSegments: 12,
                bevelEnabled: true,
                bevelThickness: 0.02,
                bevelSize: 0.05,
                bevelSegments: 0
            });

            const material = new THREE.ShaderMaterial({
                uniforms: {
                    color1: {
                        value: new THREE.Color("red")
                    },
                    color2: {
                        value: new THREE.Color("purple")
                    }
                },
                vertexShader: `
                        varying vec2 vUv;
                        void main() {
                          vUv = uv;
                          gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
                        }
                    `,
                fragmentShader: `
                        uniform vec3 color1;
                        uniform vec3 color2;
                        varying vec2 vUv;
                        void main() {
                          gl_FragColor = vec4(mix(color1, color2, vUv.y), 1.0);
                        }
                    `,
                wireframe: false // Change to true if you want wireframe
            });

            textMesh = new THREE.Mesh(textGeometry, material);

            // Appliquez une rotation initiale
            textMesh.position.set(0, 0, 0);
            textMesh.rotation.set(initialRotationX, initialRotationY, initialRotationZ);

            scene.add(textMesh);
        });
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }


    function animate() {
        requestAnimationFrame(animate);

        // Interpolez doucement vers les rotations cibles
        //textMesh.rotation.x += (targetRotationX - textMesh.rotation.x) * 0.1;
        //textMesh.rotation.y += (targetRotationY - textMesh.rotation.y) * 0.1;
        // Ajoutez ceci si vous utilisez la rotation Z
        // textMesh.rotation.z += (targetRotationZ - textMesh.rotation.z) * 0.1;

        // Modifiez la transparence du texte en fonction de la position z
        if (textMesh && textMesh.material) {
            const depth = (camera.position.z - textMesh.position.z) / (scene.fog.far - scene.fog.near);
            textMesh.material.opacity = 1.0 - depth;
            textMesh.material.transparent = false;
        }

        renderer.render(scene, camera);
    }
</script>
</body>
</html>
