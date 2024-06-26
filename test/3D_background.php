<!DOCTYPE html>
<html>
<head>
    <title>Texte 3D Interactif avec Three.js</title>
    <style>
        body { margin: 0; }
        canvas { width: 100%; height: 100% }
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://threejs.org/examples/fonts/helvetiker_regular.typeface.json"></script>
<script>
    let camera, scene, renderer, textMesh;
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
        camera.position.set(0, 0, 5);
        renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // Ajout de la lumière
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
        scene.add(ambientLight);
        const pointLight = new THREE.PointLight(0xffffff, 0.5);
        camera.add(pointLight);
        scene.add(camera);

        // Création du texte 3D
        const loader = new THREE.FontLoader();
        loader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', function (font) {
            const textGeometry = new THREE.TextGeometry('Three.js \n test', {
                font: font,
                size: 2,
                height: 0.5,
                curveSegments: 12,
                bevelEnabled: true,
                bevelThickness: 0.02,
                bevelSize: 0.05,
                bevelSegments: 0
            });

            // ... (après la création de textGeometry)
            textGeometry.computeBoundingBox();
            const offset = textGeometry.boundingBox.getCenter().negate();
            textGeometry.translate(offset.x, offset.y, offset.z);

            const textMaterial = new THREE.MeshPhongMaterial({ color: 0x999999 });
            textMesh = new THREE.Mesh(textGeometry, textMaterial);

            // Appliquez une rotation initiale
            textMesh.rotation.set(initialRotationX, initialRotationY, initialRotationZ);


            scene.add(textMesh);
        });

        // Gestionnaire d'événements pour la souris
        document.addEventListener('mousemove', onDocumentMouseMove, false);

        // Gestionnaire de redimensionnement
        window.addEventListener('resize', onWindowResize, false);
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    // Fonction pour mettre à jour la rotation en fonction de la position de la souris
    function onDocumentMouseMove(event) {
        if (textMesh) {
            const mouseX = (event.clientX / window.innerWidth) * 2 - 1;
            const mouseY = -(event.clientY / window.innerHeight) * 2 + 1;

            // Calculez la rotation autour de l'axe Z en fonction du mouvement horizontal de la souris
            // Vous pouvez ajuster la valeur 0.1 pour changer la sensibilité de la rotation sur l'axe Z
            const rotationZ = mouseX * 0.1;

            // Calculez les rotations cibles basées sur la position de la souris
            targetRotationX = initialRotationX - mouseY * rotationSpeed; // mettre + pour inverser la rotation
            targetRotationY = initialRotationY - mouseX * rotationSpeed; // mettre + pour inverser la rotation
            // Vous pouvez ajouter la rotation Z si nécessaire
            // targetRotationZ = initialRotationZ + mouseX * rotationSpeed;
            textMesh.rotation.z = initialRotationZ + rotationZ;

        }
    }

    function animate() {
        requestAnimationFrame(animate);

        // Interpolez doucement vers les rotations cibles
        textMesh.rotation.x += (targetRotationX - textMesh.rotation.x) * 0.1;
        textMesh.rotation.y += (targetRotationY - textMesh.rotation.y) * 0.1;
        // Ajoutez ceci si vous utilisez la rotation Z
        // textMesh.rotation.z += (targetRotationZ - textMesh.rotation.z) * 0.1;

        renderer.render(scene, camera);
    }
</script>
</body>
</html>
