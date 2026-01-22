<!-- 
    HERO SECTION WITH PARTICLE SPHERE
    Replace your existing <header class="hero">...</header> with this
    Also add the Three.js script before closing </body> tag
-->

<!-- Hero Section -->
<header class="hero">
    <canvas id="particle-canvas"></canvas>
    <div class="hero-bg">
        <div class="hero-gradient"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1>{{ $slide->title ?? 'Building Digital Excellence' }}</h1>
            <p class="lead">{{ $slide->description ?? 'Transform your business with cutting-edge IT solutions and innovative technology' }}</p>
            <a href="#contact" class="btn-cta">Get Started <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</header>

<!-- Add this CSS to your existing styles (inside <style> tag) -->
<style>
/* ===== HERO WITH PARTICLE SPHERE ===== */
.hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: var(--primary);
    position: relative;
    overflow: hidden;
    padding: 120px 0 80px;
}

#particle-canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero-gradient {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 30% 20%, rgba(170,19,74,0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 80%, rgba(203,148,48,0.1) 0%, transparent 50%);
    z-index: 2;
    pointer-events: none;
}

.hero .container {
    position: relative;
    z-index: 10;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 750px;
    margin: 0 auto;
}

.hero h1 {
    font-size: clamp(2.2rem, 7vw, 4rem);
    color: var(--white);
    margin-bottom: 1.25rem;
    opacity: 0;
    transform: translateY(40px);
    animation: heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.2s forwards;
}

.hero .lead {
    font-size: clamp(1rem, 2.5vw, 1.25rem);
    color: rgba(255,255,255,0.75);
    margin-bottom: 2.5rem;
    opacity: 0;
    transform: translateY(30px);
    animation: heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.4s forwards;
}

.btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
    background: linear-gradient(135deg, var(--third), var(--third-light));
    color: var(--white);
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 600;
    font-size: 1.05rem;
    border-radius: 50px;
    transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
    box-shadow: 0 8px 30px rgba(203,148,48,0.4);
    opacity: 0;
    transform: translateY(30px);
    animation: heroIn 1s cubic-bezier(0.16,1,0.3,1) 0.6s forwards;
}

.btn-cta:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 12px 40px rgba(203,148,48,0.5);
}

.btn-cta i {
    transition: transform 0.3s ease;
}

.btn-cta:hover i {
    transform: translateX(4px);
}

@keyframes heroIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- Add this script before closing </body> tag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
// Three.js Particle Sphere
class ParticleSphere {
    constructor() {
        this.canvas = document.getElementById('particle-canvas');
        if (!this.canvas) return;
        
        this.scene = new THREE.Scene();
        this.clock = new THREE.Clock();
        
        this.initCamera();
        this.initRenderer();
        this.createParticles();
        this.addEventListeners();
        this.animate();
    }

    initCamera() {
        this.camera = new THREE.PerspectiveCamera(
            75,
            window.innerWidth / window.innerHeight,
            0.1,
            1000
        );
        this.camera.position.z = 12;
    }

    initRenderer() {
        this.renderer = new THREE.WebGLRenderer({
            canvas: this.canvas,
            antialias: true,
            alpha: true
        });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        // TEQRIOUS primary color: #001348
        this.renderer.setClearColor(0x001348, 1);
    }

    createParticles() {
        const radius = 5;
        const latitudeLines = 50;
        const longitudePoints = 80;
        
        const positions = [];
        const originalPositions = [];
        const sizes = [];

        for (let lat = 0; lat < latitudeLines; lat++) {
            const phi = (Math.PI * lat) / (latitudeLines - 1);
            const ringRadius = Math.sin(phi) * radius;
            const y = Math.cos(phi) * radius;
            
            const pointsInRing = Math.max(8, Math.floor(longitudePoints * Math.sin(phi)));
            
            for (let lon = 0; lon < pointsInRing; lon++) {
                const theta = (2 * Math.PI * lon) / pointsInRing;
                
                const x = ringRadius * Math.cos(theta);
                const z = ringRadius * Math.sin(theta);
                
                positions.push(x, y, z);
                originalPositions.push(x, y, z);
                sizes.push(0.15 + Math.random() * 0.1);
            }
        }

        this.geometry = new THREE.BufferGeometry();
        this.geometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
        this.geometry.setAttribute('size', new THREE.Float32BufferAttribute(sizes, 1));
        
        this.originalPositions = new Float32Array(originalPositions);

        const vertexShader = `
            attribute float size;
            varying float vAlpha;
            void main() {
                vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
                gl_PointSize = size * (80.0 / -mvPosition.z);
                gl_Position = projectionMatrix * mvPosition;
                vAlpha = 0.4 + 0.6 * (1.0 - (mvPosition.z + 8.0) / 16.0);
            }
        `;

        const fragmentShader = `
            varying float vAlpha;
            void main() {
                vec2 center = gl_PointCoord - vec2(0.5);
                float dist = length(center);
                if (dist > 0.5) discard;
                float alpha = 1.0 - smoothstep(0.3, 0.5, dist);
                // Gold/Third color tint: rgb(203, 148, 48) = #cb9430
                gl_FragColor = vec4(0.9, 0.75, 0.4, alpha * vAlpha);
            }
        `;

        this.material = new THREE.ShaderMaterial({
            vertexShader,
            fragmentShader,
            transparent: true,
            depthWrite: false,
            depthTest: true
        });

        this.particles = new THREE.Points(this.geometry, this.material);
        this.scene.add(this.particles);

        this.mouse = new THREE.Vector2(0, 0);
        this.targetRotation = new THREE.Vector2(0, 0);
    }

    addEventListeners() {
        window.addEventListener('resize', () => this.onResize());
        window.addEventListener('mousemove', (e) => this.onMouseMove(e));
        window.addEventListener('touchmove', (e) => this.onTouchMove(e));
    }

    onResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }

    onMouseMove(event) {
        this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        this.mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    }

    onTouchMove(event) {
        if (event.touches.length > 0) {
            this.mouse.x = (event.touches[0].clientX / window.innerWidth) * 2 - 1;
            this.mouse.y = -(event.touches[0].clientY / window.innerHeight) * 2 + 1;
        }
    }

    animate() {
        requestAnimationFrame(() => this.animate());

        const time = this.clock.getElapsedTime();
        const positions = this.geometry.attributes.position.array;

        for (let i = 0; i < positions.length / 3; i++) {
            const ox = this.originalPositions[i * 3];
            const oy = this.originalPositions[i * 3 + 1];
            const oz = this.originalPositions[i * 3 + 2];

            const r = Math.sqrt(ox * ox + oy * oy + oz * oz);
            
            const wave1 = Math.sin(oy * 1.5 + time * 0.8) * 0.08;
            const wave2 = Math.sin(ox * 2 + time * 0.6) * 0.05;
            const wave3 = Math.cos(oz * 1.8 + time * 0.7) * 0.06;
            
            const displacement = 1 + wave1 + wave2 + wave3;
            
            const nx = ox / r;
            const ny = oy / r;
            const nz = oz / r;
            
            positions[i * 3] = nx * r * displacement;
            positions[i * 3 + 1] = ny * r * displacement;
            positions[i * 3 + 2] = nz * r * displacement;
        }

        this.geometry.attributes.position.needsUpdate = true;

        this.targetRotation.x = this.mouse.y * 0.4;
        this.targetRotation.y = this.mouse.x * 0.4;

        this.particles.rotation.x += (this.targetRotation.x - this.particles.rotation.x) * 0.03;
        this.particles.rotation.y += (this.targetRotation.y - this.particles.rotation.y) * 0.03;
        this.particles.rotation.y += 0.002;

        this.renderer.render(this.scene, this.camera);
    }
}

// Initialize after splash screen
window.addEventListener('load', function() {
    // Wait for splash screen to finish (3.5s + 1s exit)
    setTimeout(function() {
        new ParticleSphere();
    }, 100);
});
</script>