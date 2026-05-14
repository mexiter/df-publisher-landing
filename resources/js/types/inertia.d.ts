import '@inertiajs/core';

declare module '@inertiajs/core' {
    interface PageProps {
        appName?: string;
        flash?: {
            successTitle?: string | null;
            success?: string | null;
        };
    }
}
