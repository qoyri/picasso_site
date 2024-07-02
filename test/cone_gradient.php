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
<script src="https://cdn.jsdelivr.net/npm/three@0.115.0/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.115.0/examples/js/controls/OrbitControls.js"></script>
<script>
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(60, 1, 1, 1000);
    camera.position.set(13, 25, 38);
    camera.lookAt(scene.position);
    var renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    var canvas = renderer.domElement
    document.body.appendChild(canvas);

    var controls = new THREE.OrbitControls(camera, renderer.domElement);

    var geometry = new THREE.CylinderBufferGeometry(2, 5, 20, 32, 1, true);
    var material = new THREE.ShaderMaterial({
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
        wireframe: true
    });
    var mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);



    render();

    function resize(renderer) {
        const canvas = renderer.domElement;
        const width = canvas.clientWidth;
        const height = canvas.clientHeight;
        const needResize = canvas.width !== width || canvas.height !== height;
        if (needResize) {
            renderer.setSize(width, height, false);
        }
        return needResize;
    }

    function render() {
        if (resize(renderer)) {
            camera.aspect = canvas.clientWidth / canvas.clientHeight;
            camera.updateProjectionMatrix();
        }
        renderer.render(scene, camera);
        requestAnimationFrame(render);
    }
</script>
</body>
</html>
