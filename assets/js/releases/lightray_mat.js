import * as THREE from "../modules/three.module.min.js";

export let MakeLightrayMat = function(lightColor){
    return new THREE.ShaderMaterial({
        transparent: true,
        uniforms: {
            color: {
            value: new THREE.Color(lightColor)
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
            
            float wave = sin(vUv.x * 10.0 + uTime * 0.001);
            wave = (1.0 + wave) * 0.5;
    
            gl_FragColor = vec4(color, vUv.y * 0.5 * wave);
            }
        `,
    });
}
