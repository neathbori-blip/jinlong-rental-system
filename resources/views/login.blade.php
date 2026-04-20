<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>JinLong System · Unified Team Chat Platform</title>
    <!-- Tailwind + Fonts + Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'sans': ['Inter', 'system-ui', 'Segoe UI', 'sans-serif'] },
                    colors: { brand: { 50: '#eff6ff', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8' } },
                    boxShadow: { 'soft': '0 12px 30px -12px rgba(0, 0, 0, 0.08)', 'card': '0 20px 35px -12px rgba(0, 0, 0, 0.05)' }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .transition-smooth { transition: all 0.2s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.12); }
        .toggle-bg { background: #e2e8f0; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">

    <!-- MAIN APP WRAPPER: handles dynamic views (signup, login, dashboard) -->
    <div id="app" class="min-h-screen">
        <!-- DYNAMIC CONTENT INJECTED BY VUE/JS BUT PURE JS IMPLEMENTATION -->
    </div>

    <script>
        // ---------- FAKE DATABASE (LocalStorage based persistent user storage) ----------
        // This acts as a real client-side database: stores users, sessions, and provides full auth logic.
        // For a production environment, replace with Laravel backend API, but this fully functional demo
        // includes: register, login, session persistence, logout, protected dashboard.
        
        const DB_KEY = 'jinlong_users_db';
        const SESSION_KEY = 'jinlong_current_user';

        // Helper: load users from localStorage (initial seed if empty)
        function loadUsers() {
            const stored = localStorage.getItem(DB_KEY);
            if (stored) {
                return JSON.parse(stored);
            }
            // Seed database with a demo user (for testing)
            const defaultUsers = [
                { id: '1', accountName: 'Demo Team', email: 'demo@jinlong.com', password: 'demo123', createdAt: new Date().toISOString() }
            ];
            localStorage.setItem(DB_KEY, JSON.stringify(defaultUsers));
            return defaultUsers;
        }

        function saveUsers(users) {
            localStorage.setItem(DB_KEY, JSON.stringify(users));
        }

        // Session handling
        function getCurrentSession() {
            const session = localStorage.getItem(SESSION_KEY);
            if (!session) return null;
            try {
                return JSON.parse(session);
            } catch(e) { return null; }
        }

        function setSession(user) {
            // store safe user data without password
            const safeUser = { id: user.id, accountName: user.accountName, email: user.email };
            localStorage.setItem(SESSION_KEY, JSON.stringify(safeUser));
        }

        function clearSession() {
            localStorage.removeItem(SESSION_KEY);
        }

        // Auth helpers
        function registerUser(accountName, email, password, inviteCode) {
            const users = loadUsers();
            // check if email already exists
            const exists = users.find(u => u.email === email);
            if (exists) return { success: false, message: 'This email is already registered. Please login instead.' };
            if (!accountName || !email || !password) return { success: false, message: 'All fields are required.' };
            if (password.length < 4) return { success: false, message: 'Password must be at least 4 characters.' };
            
            const newUser = {
                id: Date.now().toString(),
                accountName: accountName.trim(),
                email: email.trim().toLowerCase(),
                password: password, // in real app, hash password; for demo store as is
                inviteCode: inviteCode || null,
                createdAt: new Date().toISOString()
            };
            users.push(newUser);
            saveUsers(users);
            return { success: true, message: 'Account created successfully!', user: newUser };
        }

        function loginUser(email, password) {
            const users = loadUsers();
            const user = users.find(u => u.email === email && u.password === password);
            if (!user) return { success: false, message: 'Invalid email or password.' };
            return { success: true, message: 'Login successful!', user: user };
        }

        // --------------------- RENDER ENGINE (pure JS) ---------------------
        const appContainer = document.getElementById('app');

        // Show Signup Form (default view)
        function renderSignup() {
            appContainer.innerHTML = `
                <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
                    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start">
                        <!-- LEFT: Registration Card -->
                        <div class="bg-white rounded-3xl shadow-card border border-gray-100/80 overflow-hidden transition-all duration-200">
                            <div class="p-6 sm:p-8 lg:p-10">
                                <div class="mb-6">
                                    <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">JinLong System</h1>
                                    <p class="text-gray-500 mt-1 text-sm">Supercharge team collaboration</p>
                                </div>
                                <div class="mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-800">Sign up and start a new account</h2>
                                    <div class="flex items-center gap-1 mt-2 text-sm text-gray-600">
                                        <span>Already have an account?</span>
                                        <a href="#" id="switchToLoginBtn" class="font-medium text-blue-600 hover:text-blue-800 transition-colors">login</a>
                                    </div>
                                </div>
                                <form id="signupForm" class="space-y-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Account name</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-building text-sm"></i></div>
                                            <input type="text" id="accName" placeholder="e.g., Acme Inc or your team name" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50/40 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all outline-none">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email address</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-envelope text-sm"></i></div>
                                            <input type="email" id="regEmail" placeholder="team@example.com" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50/40 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all outline-none">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Create a password</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-lock text-sm"></i></div>
                                            <input type="password" id="regPassword" placeholder="At least 8 characters" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50/40 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all outline-none">
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">✓ Minimum 4 characters (demo)</p>
                                    </div>
                                    
                                    <div class="flex items-start gap-2 pt-1">
                                        <input type="checkbox" id="termsAgree" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label class="text-sm text-gray-600 leading-tight">I have read and agree <a href="#" class="text-blue-600 hover:underline">Service Agreement</a>, <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a> and <a href="#" class="text-blue-600 hover:underline">User Code of Conduct</a></label>
                                    </div>
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 shadow-sm flex items-center justify-center gap-2"><i class="fas fa-rocket"></i> Create a free account</button>
                                </form>
                                <div class="relative my-7"><div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div><div class="relative flex justify-center text-xs"><span class="bg-white px-3 text-gray-400">Or continue with</span></div></div>
                                <div class="flex flex-col items-center gap-3">
                                    <div class="flex gap-5 text-gray-500 text-xl"><i class="fab fa-whatsapp hover:text-[#25D366] transition-colors cursor-pointer"></i><i class="fab fa-google hover:text-[#DB4437] transition-colors cursor-pointer"></i><i class="fab fa-weixin hover:text-[#07C160] transition-colors cursor-pointer"></i><i class="fab fa-telegram hover:text-[#26A5E4] transition-colors cursor-pointer"></i><i class="fab fa-facebook hover:text-[#1877F2] transition-colors cursor-pointer"></i></div>
                                    <a href="#" id="mailPhoneRegLink" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-full px-5 py-2 transition-all"><i class="fas fa-envelope text-gray-500"></i><span>Use Mail or Phone Registration</span><i class="fas fa-arrow-right text-xs"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- RIGHT COLUMN (visual) -->
                        <div class="space-y-8 lg:sticky lg:top-8">
                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-soft border border-white/40"><div class="flex items-start gap-4"><div class="bg-blue-50 rounded-2xl p-3"><i class="fas fa-comments text-3xl text-blue-600"></i></div><div><h3 class="text-xl font-bold text-gray-800">Shared chat allows teams to collaborate efficiently with discipline and planning</h3><p class="text-gray-600 mt-3">Consolidate all messaging channels into one backend and collaborate efficiently across teams with automated chat distribution and internal session distribution.</p></div></div></div>
                            <div class="bg-white rounded-2xl p-5 shadow-soft"><div class="flex flex-wrap items-center justify-between gap-4"><div class="text-sm font-medium text-gray-500 uppercase">Integrated channels</div><div class="flex flex-wrap gap-6 items-center"><div class="flex flex-col items-center"><i class="fab fa-whatsapp text-2xl text-gray-500 hover:text-[#25D366]"></i><span class="text-xs">WhatsApp</span></div><div class="flex flex-col items-center"><i class="fab fa-google text-2xl text-gray-500 hover:text-[#DB4437]"></i><span class="text-xs">Google</span></div><div class="flex flex-col items-center"><i class="fab fa-weixin text-2xl text-gray-500 hover:text-[#07C160]"></i><span class="text-xs">WeChat</span></div><div class="flex flex-col items-center"><i class="fab fa-telegram text-2xl text-gray-500 hover:text-[#26A5E4]"></i><span class="text-xs">Telegram</span></div><div class="flex flex-col items-center"><i class="fab fa-facebook text-2xl text-gray-500 hover:text-[#1877F2]"></i><span class="text-xs">Facebook</span></div></div></div></div>
                            <div class="grid sm:grid-cols-2 gap-4"><div class="bg-white/70 rounded-xl p-4 border"><div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center mb-2"><i class="fas fa-robot text-indigo-500"></i></div><h4 class="font-semibold">Smart routing</h4><p class="text-xs text-gray-500">AI-driven chat distribution</p></div><div class="bg-white/70 rounded-xl p-4 border"><div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center mb-2"><i class="fas fa-chart-line text-emerald-500"></i></div><h4 class="font-semibold">Analytics hub</h4><p class="text-xs text-gray-500">Team performance insights</p></div></div>
                        </div>
                    </div>
                </main>
            `;
            attachSignupEvents();
            // switch to login event
            document.getElementById('switchToLoginBtn')?.addEventListener('click', (e) => { e.preventDefault(); renderLogin(); });
            document.getElementById('mailPhoneRegLink')?.addEventListener('click', (e) => { e.preventDefault(); alert('Mail / Phone registration demo: simply use email field above to register.'); });
        }

        function attachSignupEvents() {
            const form = document.getElementById('signupForm');
            if (!form) return;
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const accountName = document.getElementById('accName')?.value.trim();
                const email = document.getElementById('regEmail')?.value.trim();
                const password = document.getElementById('regPassword')?.value;
                const inviteCode = document.getElementById('inviteCode')?.value.trim();
                const terms = document.getElementById('termsAgree')?.checked;
                if (!accountName) { alert('Please enter account name.'); return; }
                if (!email) { alert('Please enter email address.'); return; }
                if (!password || password.length < 4) { alert('Password must be at least 4 characters.'); return; }
                if (!terms) { alert('You must agree to the Terms & Conditions.'); return; }
                const result = registerUser(accountName, email, password, inviteCode);
                if (result.success) {
                    alert(`🎉 Welcome ${result.user.accountName}! Your account has been created. Please login.`);
                    renderLogin();
                } else {
                    alert(`Registration failed: ${result.message}`);
                }
            });
        }

        // RENDER LOGIN FORM
        function renderLogin() {
            appContainer.innerHTML = `
                <main class="max-w-md mx-auto px-4 py-12 md:py-20">
                    <div class="bg-white rounded-3xl shadow-card border border-gray-100 p-8">
                        <div class="text-center mb-6">
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">JinLong System</h1>
                            <p class="text-gray-500 text-sm">Welcome back! Sign in to your account</p>
                        </div>
                        <form id="loginForm" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fas fa-envelope"></i></div>
                                    <input type="email" id="loginEmail" placeholder="your@email.com" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fas fa-lock"></i></div>
                                    <input type="password" id="loginPassword" placeholder="••••••••" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2"><i class="fas fa-arrow-right-to-bracket"></i> Sign in</button>
                        </form>
                        <div class="mt-6 text-center text-sm text-gray-500">
                            Don't have an account? <a href="#" id="switchToSignupFromLogin" class="text-blue-600 font-medium hover:underline">Create free account</a>
                        </div>
                        <div class="mt-8 pt-4 border-t text-center text-xs text-gray-400">
                            <i class="fas fa-comments"></i> Unified team chat · Secure login
                        </div>
                    </div>
                </main>
            `;
            const loginForm = document.getElementById('loginForm');
            loginForm?.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = document.getElementById('loginEmail')?.value.trim();
                const password = document.getElementById('loginPassword')?.value;
                if (!email || !password) { alert('Please enter email and password.'); return; }
                const result = loginUser(email, password);
                if (result.success) {
                    setSession(result.user);
                    renderDashboard(result.user);
                } else {
                    alert(`Login failed: ${result.message}`);
                }
            });
            document.getElementById('switchToSignupFromLogin')?.addEventListener('click', (e) => { e.preventDefault(); renderSignup(); });
        }

        // DASHBOARD (protected area) with logout and team collaboration features
        function renderDashboard(user) {
            if (!user) {
                renderLogin();
                return;
            }
            appContainer.innerHTML = `
                <div class="max-w-6xl mx-auto px-4 py-6 md:py-10">
                    <!-- Navbar -->
                    <div class="flex flex-wrap justify-between items-center gap-4 mb-8 pb-4 border-b border-gray-200">
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-800 to-gray-700 bg-clip-text text-transparent">JinLong System</h1>
                            <p class="text-sm text-gray-500">Dashboard · Team Collaboration Hub</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 rounded-full px-4 py-2 text-sm font-medium text-blue-700"><i class="fas fa-user-circle mr-2"></i>${escapeHtml(user.accountName)}</div>
                            <button id="logoutBtn" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-xl transition flex items-center gap-2"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </div>
                    </div>

                    <!-- Welcome Hero + Real-time chat mockup -->
                    <div class="grid lg:grid-cols-3 gap-6 mb-8">
                        <div class="lg:col-span-2 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 shadow-sm border border-blue-100">
                            <div class="flex items-center gap-3 mb-3"><i class="fas fa-comment-dots text-blue-600 text-2xl"></i><h2 class="text-xl font-bold">Welcome back, ${escapeHtml(user.accountName)}</h2></div>
                            <p class="text-gray-700">Your team workspace is ready. Integrated WhatsApp, WeChat, Telegram, Google and Facebook channels are synced. Start collaborating with smart routing and unified inbox.</p>
                            <div class="mt-5 flex flex-wrap gap-3"><span class="bg-white/70 rounded-full px-3 py-1 text-xs font-medium text-gray-700"><i class="fab fa-whatsapp mr-1"></i> WhatsApp active</span><span class="bg-white/70 rounded-full px-3 py-1 text-xs"><i class="fab fa-weixin"></i> WeChat active</span><span class="bg-white/70 rounded-full px-3 py-1 text-xs"><i class="fab fa-telegram"></i> Telegram active</span></div>
                        </div>
                        <div class="bg-white rounded-2xl p-5 shadow-soft border">
                            <div class="flex items-center justify-between mb-3"><h3 class="font-semibold"><i class="fas fa-chart-simple mr-2 text-blue-500"></i>Team Stats</h3><i class="fas fa-ellipsis-h text-gray-400"></i></div>
                            <div class="space-y-2 text-sm"><div class="flex justify-between"><span>Active sessions</span><span class="font-medium">12</span></div><div class="flex justify-between"><span>Messages today</span><span class="font-medium">284</span></div><div class="flex justify-between"><span>Response rate</span><span class="font-medium text-green-600">98%</span></div></div>
                            <div class="mt-4 pt-3 border-t text-center"><span class="text-xs text-gray-400">Last sync: just now</span></div>
                        </div>
                    </div>

                    <!-- Integrated channels and action area -->
                    <div class="bg-white rounded-2xl shadow-sm border p-5 mb-8">
                        <div class="flex flex-wrap justify-between items-center gap-3"><h3 class="font-bold text-gray-800"><i class="fas fa-plug mr-2 text-blue-500"></i>Connected messaging channels</h3><button class="text-blue-600 text-sm bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100">+ Add integration</button></div>
                        <div class="flex flex-wrap gap-6 mt-5 text-center">
                            <div><i class="fab fa-whatsapp text-3xl text-[#25D366]"></i><p class="text-xs mt-1">WhatsApp Business</p></div>
                            <div><i class="fab fa-google text-3xl text-[#DB4437]"></i><p class="text-xs mt-1">Google Chat</p></div>
                            <div><i class="fab fa-weixin text-3xl text-[#07C160]"></i><p class="text-xs mt-1">WeChat</p></div>
                            <div><i class="fab fa-telegram text-3xl text-[#26A5E4]"></i><p class="text-xs mt-1">Telegram</p></div>
                            <div><i class="fab fa-facebook text-3xl text-[#1877F2]"></i><p class="text-xs mt-1">Facebook Messenger</p></div>
                        </div>
                    </div>

                    <!-- Shared chat simulation (team collaboration demo) -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl border shadow-sm p-4">
                            <div class="flex items-center gap-2 border-b pb-2 mb-3"><i class="fas fa-users text-blue-500"></i><span class="font-medium">Team Live Chat</span><span class="text-xs bg-green-100 text-green-700 px-2 rounded-full ml-auto">active</span></div>
                            <div class="space-y-3 max-h-64 overflow-y-auto text-sm">
                                <div class="flex gap-2"><div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-xs">JD</div><div class="bg-gray-100 rounded-2xl px-3 py-2 max-w-xs"><span class="font-bold text-xs">John:</span> <span class="text-gray-700">Shared inbox working great!</span></div></div>
                                <div class="flex gap-2 justify-end"><div class="bg-blue-500 text-white rounded-2xl px-3 py-2 max-w-xs"><span>Automated routing solved our support backlog.</span></div><div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-xs">You</div></div>
                                <div class="flex gap-2"><div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-xs">SW</div><div class="bg-gray-100 rounded-2xl px-3 py-2"><span class="font-bold text-xs">Sarah:</span> <span class="text-gray-700">Analytics show 30% faster response</span></div></div>
                            </div>
                            <div class="mt-3 flex gap-2"><input type="text" placeholder="Type a message..." class="flex-1 border rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-300"><button class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-blue-700"><i class="fas fa-paper-plane"></i></button></div>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border p-5 shadow-sm">
                            <h3 class="font-semibold flex items-center gap-2"><i class="fas fa-chalkboard-user text-indigo-500"></i>Collaboration planning</h3>
                            <p class="text-sm text-gray-600 mt-2">Consolidate messaging channels, distribute chats intelligently, and keep your team aligned. JinLong System provides discipline and data-driven planning for modern teams.</p>
                            <div class="mt-4 flex gap-2 flex-wrap"><span class="bg-blue-50 text-blue-700 text-xs rounded-full px-3 py-1"><i class="fas fa-robot mr-1"></i>AI distribution</span><span class="bg-emerald-50 text-emerald-700 text-xs rounded-full px-3 py-1"><i class="fas fa-chart-line"></i> performance</span><span class="bg-purple-50 text-purple-700 text-xs rounded-full px-3 py-1"><i class="fas fa-shield-alt"></i> SLA tracking</span></div>
                        </div>
                    </div>
                    <div class="mt-10 text-center text-xs text-gray-400 border-t pt-6">© 2025 JinLong System — Secure team collaboration platform. All integrations live.</div>
                </div>
            `;
            document.getElementById('logoutBtn')?.addEventListener('click', (e) => {
                clearSession();
                renderLogin();
            });
            // attach simple chat simulation (just for fun)
            const sendBtn = document.querySelector('.bg-blue-600.text-white');
            const chatInput = document.querySelector('input[placeholder="Type a message..."]');
            if (sendBtn && chatInput) {
                const newSend = sendBtn.cloneNode(true);
                sendBtn.parentNode.replaceChild(newSend, sendBtn);
                newSend.addEventListener('click', () => {
                    const msg = chatInput.value.trim();
                    if (msg) alert(`[Demo] Message sent: "${msg}"\n(real-time chat would be stored in backend DB.)`);
                    chatInput.value = '';
                });
            }
        }

        function escapeHtml(str) { if(!str) return ''; return str.replace(/[&<>]/g, function(m){ if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;}); }

        // ---- INIT: check session & render appropriate view ----
        const currentUser = getCurrentSession();
        if (currentUser && currentUser.id) {
            renderDashboard(currentUser);
        } else {
            renderSignup();
        }
    </script>
</body>
</html>