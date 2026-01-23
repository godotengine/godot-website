import * as THREE from "../modules/three.module.min.js";
import { GLTFLoader } from "../modules/GLTFLoader.js";

// Source - https://stackoverflow.com/a
// Posted by Alnitak, modified by community. See post 'Timeline' for change history
// Retrieved 2026-01-20, License - CC BY-SA 3.0

function mapRange(value, low1, high1, low2, high2) {
    return low2 + (high2 - low2) * (value - low1) / (high1 - low1);
}

function clamp(number, min, max) {
    return Math.max(min, Math.min(number, max));
}

const container = document.querySelector("#three-container");
const canvas = document.querySelector("#three-canvas");

let mouse = {x: 0.0, y: 0.0}
let scrollPercent = 0.0;
let camera;
let rightSceneRoot = undefined;

const scene = new THREE.Scene();
scene.background = new THREE.Color( 0x151515 );
const renderer = new THREE.WebGLRenderer({antialias: true, canvas: canvas, stencil: true});
renderer.outputColorSpace = THREE.LinearSRGBColorSpace;
renderer.toneMapping = THREE.ReinhardToneMapping;
renderer.toneMappingExposure = 1.5;


const options = {
    rootMargin: "0px",
    scrollMargin: "0px",
    threshold: 0.0,
};

const observerCallback = function(entries, observer){
    entries.forEach((entry)=>{
        if(entry.target != container) return;
        if(entry.isIntersecting){
            play();
        }else{
            stop();
        }
    });
};

const observer = new IntersectionObserver(observerCallback, options);
observer.observe(container);

document.body.addEventListener("pointermove", function(e){
    if (e.buttons != 0) return;
    mouse.x = e.clientX / container.clientWidth;
    mouse.y = e.clientY / container.clientHeight;
})

window.addEventListener("scroll", (event) => {
    scrollPercent = window.scrollY / container.clientHeight;
})

window.addEventListener("resize", (e) => {updateViewportSize()});

function updateViewportSize(){
    let w = container.clientWidth * window.devicePixelRatio,
        h = container.clientHeight * window.devicePixelRatio;
    let ratio = w / h;

    camera.aspect = ratio;
    renderer.setSize(w, h, false);

    if(rightSceneRoot){
        rightSceneRoot.position.x = mapRange(clamp(ratio, 0.5, 1.5), 0.5, 1.5, 2.5, 5.0);
        rightSceneRoot.position.y = mapRange(clamp(ratio, 0.5, 1.5), 0.5, 1.5, -1.5, 0.0);
    }
    camera.fov = mapRange(clamp(ratio, 0.5, 1.5), 0.5, 1.5, 35.0, 25.0);
    camera.updateProjectionMatrix();
}

const ambientLight = new THREE.AmbientLight(0xFFFFFF, 1.6);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xFFFFFF, 8.5);
directionalLight.position.set(-0.5, 1, 1);
directionalLight.target.position.set(0.0, 0, 0);
scene.add(directionalLight);
scene.add(directionalLight.target);

const backLight = new THREE.DirectionalLight(0xb5e3ff, 4.0);
backLight.position.set(0.5, -0.5, -1);
backLight.target.position.set(0.0, 0, 0);
scene.add(backLight);
scene.add(backLight.target);


let mixer;
let clock = new THREE.Clock();

function animate() {        
    const dt = clock.getDelta();
    if ( screenLightsMat ) screenLightsMat.uniforms.uTime.value = window.performance.now();
    if ( mixer ) mixer.update( dt );
    if (camera){
        camera.position.x = (mouse.x - 0.5) * 0.5;
        camera.position.y = -(mouse.y - 0.5) * 0.25 -scrollPercent;
        renderer.render( scene, camera );
    }
}

function play(){
    renderer.setAnimationLoop(animate);
}

function stop(){
    renderer.setAnimationLoop(null);
}


var gradientMat = new THREE.ShaderMaterial({
    transparent: true,
  uniforms: {
    color: {
      value: new THREE.Color("#49a7ff")
    },
  },
  vertexShader: `
    varying vec2 vUv;

    void main() {
      vUv = uv;
      gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
    }
  `,
  fragmentShader: `
    uniform vec3 color;
  
    varying vec2 vUv;
    
    void main() {
      
      gl_FragColor = vec4(color, (1.0 - length(vUv.xy - vec2(1.0)))  );
    }
  `,
});

var sphereGradientMat = new THREE.ShaderMaterial({
    transparent: true,
  uniforms: {
    color: {
      value: new THREE.Color("rgba(73, 255, 158, 1)")
    },
  },
  vertexShader: `
    varying vec2 vUv;

    void main() {
      vUv = uv;
      gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
    }
  `,
  fragmentShader: `
    uniform vec3 color;

    varying vec2 vUv;
    
    void main() {
      
      gl_FragColor = vec4(color,  round(1.0 - length(vUv.xy - vec2(0.5))) * (1.0 - (vUv.y - 0.5) * 2.0) * 0.2);
    }
  `,
});

var screenLightsMat = new THREE.ShaderMaterial({
    transparent: true,
    uniforms: {
        color: {
        value: new THREE.Color("#49a7ff")
        },
        uTime: {
            value: 0.0
        },
    },
    vertexShader: `
        varying vec2 vUv;

        void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
        }
    `,
    fragmentShader: `
        uniform vec3 color;
        uniform float uTime;

        varying vec2 vUv;
        
        void main() {
        
        float wave = sin(vUv.x * 20.0 + uTime * 0.001);
        wave = (1.0 + wave) * 0.5;

        gl_FragColor = vec4(color, vUv.y * 0.6 * wave);
        }
    `,
});

var gridMat = new THREE.ShaderMaterial({
    transparent: true,
    side: THREE.DoubleSide,
    uniforms: {
        color: {
        value: new THREE.Color("#ffffff")
        },
        gridSampler: { type: "t", value: null}

    },
    vertexShader: `
        varying vec2 vUv;

        void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
        }
    `,
    fragmentShader: `
        uniform vec3 color;
        uniform sampler2D gridSampler;        
        varying vec2 vUv;
        
        void main() {

        gl_FragColor = vec4(color, texture2D(gridSampler, vUv * 5.0).x * (1.0 - length(vUv.xy - vec2(0.5)) * 2.0) * 0.25);
        }
    `,
});

const gridTextureLoader = new THREE.TextureLoader();
const texture = gridTextureLoader.load(import.meta.resolve('./3d_grid.png'), (r)=>{
    r.wrapS = THREE.RepeatWrapping;
    r.wrapT = THREE.RepeatWrapping;
    r.minFilter = THREE.NearestFilter;
    r.magFilter = THREE.NearestFilter;
    
    gridMat.uniforms.gridSampler.value = r;
    gridMat.needsUpdate = true;
});

const stencilMat = new THREE.MeshPhongMaterial({ color: 'white' });
stencilMat.depthWrite = false;
stencilMat.stencilWrite = true;
stencilMat.stencilRef = 1;
stencilMat.stencilFunc = THREE.AlwaysStencilFunc;
stencilMat.stencilZPass = THREE.ReplaceStencilOp;


const loader = new GLTFLoader();

loader.load(import.meta.resolve("./banner.glb"), function ( gltf ) {
    let GLBScene = gltf.scene;
    GLBScene.position.x = 2.0;
    
    GLBScene.traverse(function(child) {
        if(child.name == "RightSceneRoot"){
            rightSceneRoot = child;
        }
        if(child.name == "Camera"){
            camera = child;
        }
        if(child.name.includes("ScreenLights")) child.material = screenLightsMat;
        if(child.name.includes("MaskGrid")) child.material = gridMat;
        if(child.name.includes("Plane")) child.material = gradientMat;
        if(child.name.includes("GradientSphere")) child.material = sphereGradientMat;
        if(child.name.includes("Stencil")) {
            child.material = stencilMat;
        };
        if(child.name.includes("Mask")){
            child.material.stencilWrite = true;
            child.material.stencilRef = 1;
            child.material.stencilFunc = THREE.EqualStencilFunc;
        };

    });

    mixer = new THREE.AnimationMixer( GLBScene );
    const clip = THREE.AnimationClip.findByName( gltf.animations, 'Scene' );
    const action = mixer.clipAction( clip );
    action.play();

    scene.add( GLBScene );

    updateViewportSize();

    container.classList.add("loaded");

}, undefined, function ( error ) {
    console.error( error );
} );

play();