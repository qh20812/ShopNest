
function AuthForm({ title, onSubmit, children, footer }) {
    return (
        <div className="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <h2 className="text-2xl font-bold text-center text-gray-900 mb-6">{title}</h2>
            <form className="space-y-4" onSubmit={onSubmit}>
                {children}
                <button
                    type="submit"
                    className="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                >
                    {title}
                </button>
            </form>
            {footer && <div className="mt-4 text-center text-sm text-gray-600">{footer}</div>}
        </div>
    );
}

export default AuthForm;