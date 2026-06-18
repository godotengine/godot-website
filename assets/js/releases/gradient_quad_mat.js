import*as THREE from"../modules/three.module.min.js";export let MakeGradientMat=function(e){return new THREE.ShaderMaterial({transparent:!0,uniforms:{color:{value:new THREE.Color(e)}},vertexShader:`
            varying vec2 vUv;
    
            void main() {
                vUv = uv;
                gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
            }
        `,fragmentShader:`
            uniform vec3 color;
        
            varying vec2 vUv;
            
            void main() {
                gl_FragColor = vec4(color, (1.0 - length(vUv.xy - vec2(1.0))));
            }
        `})}