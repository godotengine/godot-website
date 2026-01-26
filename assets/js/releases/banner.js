import*as THREE from"../modules/three.module.min.js";import{GLTFLoader}from"../modules/GLTFLoader.js";function mapRange(e,t,n,s,o){return s+(o-s)*(e-t)/(n-t)}function clamp(e,t,n){return Math.max(t,Math.min(e,n))}const container=document.querySelector("#three-container"),canvas=document.querySelector("#three-canvas");let mouse={x:0,y:0},scrollPercent=0,camera,rightSceneRoot=void 0;const scene=new THREE.Scene;scene.background=new THREE.Color(1381653);const renderer=new THREE.WebGLRenderer({antialias:!0,canvas,stencil:!0});renderer.outputColorSpace=THREE.LinearSRGBColorSpace,renderer.toneMapping=THREE.ReinhardToneMapping,renderer.toneMappingExposure=1.5;const options={rootMargin:"0px",scrollMargin:"0px",threshold:0},observerCallback=function(e){e.forEach(e=>{if(e.target!=container)return;e.isIntersecting?play():stop()})},observer=new IntersectionObserver(observerCallback,options);observer.observe(container),document.body.addEventListener("pointermove",function(e){if(e.buttons!=0)return;mouse.x=e.clientX/container.clientWidth,mouse.y=e.clientY/container.clientHeight}),window.addEventListener("scroll",e=>{scrollPercent=window.scrollY/container.clientHeight}),window.addEventListener("resize",e=>{updateViewportSize()});function updateViewportSize(){let t=container.clientWidth*window.devicePixelRatio,n=container.clientHeight*window.devicePixelRatio,e=t/n;camera.aspect=e,renderer.setSize(t,n,!1),rightSceneRoot&&(rightSceneRoot.position.x=mapRange(clamp(e,.5,1.5),.5,1.5,2.5,5),rightSceneRoot.position.y=mapRange(clamp(e,.5,1.5),.5,1.5,-1.5,0)),camera.fov=mapRange(clamp(e,.5,1.5),.5,1.5,35,25),camera.updateProjectionMatrix()}const ambientLight=new THREE.AmbientLight(16777215,1.6);scene.add(ambientLight);const directionalLight=new THREE.DirectionalLight(16777215,8.5);directionalLight.position.set(-.5,1,1),directionalLight.target.position.set(0,0,0),scene.add(directionalLight),scene.add(directionalLight.target);const backLight=new THREE.DirectionalLight(11920383,4);backLight.position.set(.5,-.5,-1),backLight.target.position.set(0,0,0),scene.add(backLight),scene.add(backLight.target);let mixer,clock=new THREE.Clock;function animate(){const e=clock.getDelta();screenLightsMat&&(screenLightsMat.uniforms.uTime.value=window.performance.now()),mixer&&mixer.update(e),camera&&(camera.position.x=(mouse.x-.5)*.5,camera.position.y=-(mouse.y-.5)*.25-scrollPercent,renderer.render(scene,camera))}function play(){renderer.setAnimationLoop(animate)}function stop(){renderer.setAnimationLoop(null)}var gradientMat=new THREE.ShaderMaterial({transparent:!0,uniforms:{color:{value:new THREE.Color("#49a7ff")}},vertexShader:`
    varying vec2 vUv;

    void main() {
      vUv = uv;
      gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
    }
  `,fragmentShader:`
    uniform vec3 color;
  
    varying vec2 vUv;
    
    void main() {
      
      gl_FragColor = vec4(color, (1.0 - length(vUv.xy - vec2(1.0)))  );
    }
  `}),sphereGradientMat=new THREE.ShaderMaterial({transparent:!0,uniforms:{color:{value:new THREE.Color("rgba(73, 255, 158, 1)")}},vertexShader:`
    varying vec2 vUv;

    void main() {
      vUv = uv;
      gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
    }
  `,fragmentShader:`
    uniform vec3 color;

    varying vec2 vUv;
    
    void main() {
      
      gl_FragColor = vec4(color,  round(1.0 - length(vUv.xy - vec2(0.5))) * (1.0 - (vUv.y - 0.5) * 2.0) * 0.2);
    }
  `}),screenLightsMat=new THREE.ShaderMaterial({transparent:!0,uniforms:{color:{value:new THREE.Color("#49a7ff")},uTime:{value:0}},vertexShader:`
        varying vec2 vUv;

        void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
        }
    `,fragmentShader:`
        uniform vec3 color;
        uniform float uTime;

        varying vec2 vUv;
        
        void main() {
        
        float wave = sin(vUv.x * 20.0 + uTime * 0.001);
        wave = (1.0 + wave) * 0.5;

        gl_FragColor = vec4(color, vUv.y * 0.6 * wave);
        }
    `}),gridMat=new THREE.ShaderMaterial({transparent:!0,side:THREE.DoubleSide,uniforms:{color:{value:new THREE.Color("#ffffff")},gridSampler:{type:"t",value:null}},vertexShader:`
        varying vec2 vUv;

        void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);
        }
    `,fragmentShader:`
        uniform vec3 color;
        uniform sampler2D gridSampler;        
        varying vec2 vUv;
        
        void main() {

        gl_FragColor = vec4(color, texture2D(gridSampler, vUv * 5.0).x * (1.0 - length(vUv.xy - vec2(0.5)) * 2.0) * 0.25);
        }
    `});const gridTextureLoader=new THREE.TextureLoader,texture=gridTextureLoader.load(import.meta.resolve("./3d_grid.png"),e=>{e.wrapS=THREE.RepeatWrapping,e.wrapT=THREE.RepeatWrapping,e.minFilter=THREE.NearestFilter,e.magFilter=THREE.NearestFilter,gridMat.uniforms.gridSampler.value=e,gridMat.needsUpdate=!0}),stencilMat=new THREE.MeshPhongMaterial({color:"white"});stencilMat.depthWrite=!1,stencilMat.stencilWrite=!0,stencilMat.stencilRef=1,stencilMat.stencilFunc=THREE.AlwaysStencilFunc,stencilMat.stencilZPass=THREE.ReplaceStencilOp;const loader=new GLTFLoader;loader.load(import.meta.resolve("./banner.glb"),function(e){let t=e.scene;t.position.x=2,t.traverse(function(e){e.name=="RightSceneRoot"&&(rightSceneRoot=e),e.name=="Camera"&&(camera=e),e.name.includes("ScreenLights")&&(e.material=screenLightsMat),e.name.includes("MaskGrid")&&(e.material=gridMat),e.name.includes("Plane")&&(e.material=gradientMat),e.name.includes("GradientSphere")&&(e.material=sphereGradientMat),e.name.includes("Stencil")&&(e.material=stencilMat),e.name.includes("Mask")&&(e.material.stencilWrite=!0,e.material.stencilRef=1,e.material.stencilFunc=THREE.EqualStencilFunc)}),mixer=new THREE.AnimationMixer(t);const n=THREE.AnimationClip.findByName(e.animations,"Scene"),s=mixer.clipAction(n);s.play(),scene.add(t),updateViewportSize(),container.classList.add("loaded")},void 0,function(e){console.error(e)}),play()