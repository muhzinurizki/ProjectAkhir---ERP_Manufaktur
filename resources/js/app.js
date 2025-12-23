import './bootstrap';
import '../css/app.css';
import 'flowbite';

import { createIcons } from 'lucide';

createIcons();

import Swal from 'sweetalert2';

window.Swal = Swal;


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
