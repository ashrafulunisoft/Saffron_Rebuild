{{-- Common E-commerce Styles --}}
<style>
    .stat-card {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 1.5rem;
        transition: 0.3s;
    }

    .stat-card:hover {
        border-color: rgba(59, 130, 246, 0.3);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: rgba(15, 23, 42, 0.8);
        color: #fff;
        padding: 1rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: left;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr {
        background: rgba(15, 23, 42, 0.3);
        transition: 0.2s;
        border-bottom: 1px solid rgba(255,255,255,0.03);
    }

    .table-custom tbody tr:hover {
        background: rgba(59, 130, 246, 0.1);
    }

    .table-custom td {
        padding: 1rem;
        color: rgba(255, 255, 255, 0.8);
        vertical-align: middle;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .badge-visit-type {
        background: rgba(59, 130, 246, 0.2);
        color: var(--accent-blue);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge-approved {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .badge-pending {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .badge-cancelled {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-completed {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 0.35rem;
        flex-wrap: wrap;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        font-size: 0.85rem;
        text-decoration: none;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.2);
        color: var(--accent-blue);
    }

    .btn-view:hover {
        background: var(--accent-blue);
        color: #fff;
    }

    .btn-edit {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-edit:hover {
        background: #fbbf24;
        color: #000;
    }

    .btn-approve {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .btn-approve:hover {
        background: #22c55e;
        color: #fff;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    .input-dark {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        transition: 0.3s;
        width: 100%;
    }

    .input-dark:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .input-dark::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .input-custom {
        font-size: 0.9rem;
    }

    

    textarea.input-dark,
    select.input-dark {
        padding-left: 1rem;
    }

    select.input-dark {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.75rem;
    }

    textarea.input-dark {
        padding-top: 0.75rem;
        resize: vertical;
    }

    .permission-title {
        color: var(--accent-blue);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
    }

    .form-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.1);
    }

    .glass-card-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(59, 130, 246, 0.1);
    }

    .logo-vms {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .text-shadow-white {
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
    }

    .text-shadow-blue {
        text-shadow: 0 2px 10px rgba(59, 130, 246, 0.5);
    }

    .page-link {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: 0.2s;
    }

    .page-link:hover {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
    }

    .page-item.active .page-link {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
    }
</style>
