<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page en chargement...</title>
    <style>
        /* Créer un spinner de chargement simple */
        .loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #3498db;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        #loading {
            position: fixed; /* Fixe le chargement par rapport à la fenêtre du navigateur */
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* S'assure que l'écran de chargement est au-dessus de tout le reste */
            background: white; /* Ajouter une couleur d'arrière-plan pour masquer le contenu de la page */
        }

        /* Animation de rotation pour Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        /* Animation de rotation standard */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<!-- La page de chargement -->
<div id="loading" style="display:flex;justify-content:center;align-items:center;height:100vh;">
    <div class="loader"></div>
</div>

<!-- La page de contenu, cachée au départ -->
<div id="content" style="display:none;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script>
        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );
        var renderer = new THREE.WebGLRenderer({antialias: true});
        var loader = new THREE.GLTFLoader();
        var controls = new THREE.OrbitControls( camera, renderer.domElement );

        var textureLoader = new THREE.TextureLoader();

        textureLoader.load('test/texture/Jeune-fille-devant-un-miroir.jpg', function ( texture ) {
            texture.flipY = false; // renverse la texture sur l'axe Y
            var materialTab = new THREE.MeshBasicMaterial( { map: texture } );

            const materialTab2 = new THREE.MeshStandardMaterial({
                color: 0xD4AF37,
                metalness: 1, // définit à quel point le matériau est métallique, entre 0 (non métallique) à 1 (métallique)
                roughness: 0.5, // définit à quel point le matériau est rugueux, de 0 (lisse) à 1 (rugueux)
                emissive: 0xD4AF55, // Couleur d'émission, définie à une couleur rougeâtre
                emissiveIntensity: 0.1 // Intensité de l'émission, varie de 0 à 1
            });

            loader.load( 'test/tableau.gltf', function ( gltf ) {
                    gltf.scene.rotation.y = Math.PI; // rotation de 180 degrés
                    var count = 0;
                    gltf.scene.traverse( function ( node ) {
                        if ( node instanceof THREE.Mesh ) {
                            if (count === 0) {
                                node.material = materialTab2;
                            }
                            else if (count === 1) {
                                node.material = materialTab;
                            }
                            count++;
                        }
                    });
                    scene.add( gltf.scene );
                },
                undefined,
                function ( error ) { console.error( error ); });

            renderer.setSize( window.innerWidth, window.innerHeight );
            document.body.appendChild( renderer.domElement );

            // for damping (optional)
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;

            var directionalLight = new THREE.DirectionalLight( 0xffffff, 0.5 );
            scene.add( directionalLight );

            var light = new THREE.AmbientLight( 0x404040 ); // soft white light
            scene.add( light );

            camera.position.z = 5;
            controls.update();

            var animate = function () {
                requestAnimationFrame( animate );
                controls.update();
                renderer.render( scene, camera );
            };

            animate();
        });
    </script>
</div>

<script>
    // Notre script pour cacher la page de chargement et afficher le contenu
    document.addEventListener('DOMContentLoaded', function() {
        // Utiliser setTimeout pour ajouter un délai de 3 secondes
        setTimeout(function() {
            // Cacher la page de chargement et afficher le contenu
            document.getElementById('loading').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }, 3000); // 3000 millisecondes équivalent à 3 secondes
    });
</script>
</body>
</html>