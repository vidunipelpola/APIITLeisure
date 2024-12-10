import './bootstrap';
import Alpine from 'alpinejs';
import { notificationPopup } from './notification-popup';

window.Alpine = Alpine;
Alpine.data('notificationPopup', notificationPopup);
Alpine.start();
