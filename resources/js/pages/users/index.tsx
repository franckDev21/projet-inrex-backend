import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Management',
        href: '/users',
    },
];

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Utilisateurs" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                Hello - UPDATE, this is the user management page. You can manage users here.
            </div>
        </AppLayout>
    );
}
