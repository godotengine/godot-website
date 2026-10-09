import * as THREE from "../modules/three.module.min.js";
import { GLTFLoader } from "../modules/GLTFLoader.js";

export class ReleaseBanner{
    constructor(container_id, canvas_id){
        this.container = document.querySelector(container_id);
        this.canvas = document.querySelector(canvas_id);
        this.scene = new THREE.Scene();
        // this.scene.background = new THREE.Color( 0x151515 );

        this.renderer = new THREE.WebGLRenderer({antialias: true, canvas: this.canvas});
        this.renderer.outputColorSpace = THREE.LinearSRGBColorSpace;
        this.renderer.toneMapping = THREE.ReinhardToneMapping;
        this.renderer.toneMappingExposure = 1.8;

        this.renderer.shadowMap.enabled = true
        this.renderer.shadowMap.type = THREE.PCFShadowMap
        this.renderer.shadowMap.alias = true
        this.renderer.shadowMap.width=1024
        this.renderer.shadowMap.height=1024

        this.timer = new THREE.Timer();
        this.timer.connect( document );

        this.sceneCamera = null;

        this.viewSize = {x: 0.0, y: 0.0};

        this.mouse = new THREE.Vector2( 0.5, 0.5 );

        this.observer = new IntersectionObserver(this.IntersectionObserverCallback.bind(this), {
            rootMargin: "0px",
            scrollMargin: "0px",
            threshold: 0.0,
        });
        this.observer.observe(this.container);

        this.events = new THREE.EventDispatcher();

        window.addEventListener("resize", (_e) => { this.checkForResize() });
        window.addEventListener("pointermove", this.onPointerMove.bind(this));

        let themeMatch = window.matchMedia("(prefers-color-scheme: dark)");
        this.useDarkTheme = themeMatch.matches;
    
        themeMatch.addEventListener("change", (event) => {
            this.useDarkTheme = event.matches;
            this.events.dispatchEvent({ type: "colorSchemeChanged" });
        });

        this.loadingManager = THREE.DefaultLoadingManager;
        this.loadingManager.onLoad = () => {
            this.checkForResize();
            this.container.classList.add("loaded");
            this.events.dispatchEvent({ type: "ready" });
        };

    }

    checkForResize(){
        const pixelRatio = window.devicePixelRatio;
        let width  = Math.floor( this.container.clientWidth  * pixelRatio );
        let height = Math.floor( this.container.clientHeight * pixelRatio );

        const maxPixelCount= 3840*2160;
        const pixelCount = width * height;
        const renderScale = pixelCount > maxPixelCount ? Math.sqrt(maxPixelCount / pixelCount) : 1;

        this.viewSize.x = Math.floor(width * renderScale);
        this.viewSize.y = Math.floor(height * renderScale);

        const needResize = (
            this.canvas.width !== this.viewSize.x 
            || 
            this.canvas.height !== this.viewSize.y
        );

        if(needResize) this.resizeRenderer(this.viewSize.x, this.viewSize.y);
    }

    resizeRenderer(width, height){
        this.renderer.setSize( width, height, false);
        if (this.sceneCamera){
            this.sceneCamera.aspect = width / height;
            this.sceneCamera.updateProjectionMatrix();
        }
        this.events.dispatchEvent({ type: "resized" });
    }

    onPointerMove(event) {
        if (event.buttons != 0) return;
        this.mouse.x = event.clientX / this.viewSize.x;
        this.mouse.y = event.clientY / this.viewSize.y;
    }

    IntersectionObserverCallback(entries, observer){
        entries.forEach((entry)=>{
            if(entry.target != this.container) return;
            this.events.dispatchEvent({ type: "visibilityChanged", visible: entry.isIntersecting});
            if(entry.isIntersecting){
                this.play();
            }else{
                this.stop();
            }
        });
    }

    play(){
        this.renderer.setAnimationLoop(this.animate.bind(this));
    }

    stop(){
        this.renderer.setAnimationLoop(null);
    }

    animate(timestamp){
        const delta = this.timer.getDelta();
        if ( this.sceneCamera ) this.renderer.render( this.scene, this.sceneCamera );
        if ( this.mixer ) this.mixer.update( delta );
        this.process(delta);
        this.timer.update(timestamp);
    }

    process(delta){

    }

    loadScene(GLBScenePath){
        const loader = new GLTFLoader();
        loader.load(import.meta.resolve(GLBScenePath), glb => {
            this.scene.add(glb.scene);

            glb.scene.traverse((child) => {
                if (child instanceof THREE.Camera) {
                    this.sceneCamera = child;
                }
            });
    
            this.mixer = new THREE.AnimationMixer( glb.scene );
            const clip = THREE.AnimationClip.findByName( glb.animations, 'Scene' );
            const action = this.mixer.clipAction( clip );
            action.play();

        });
    }
}