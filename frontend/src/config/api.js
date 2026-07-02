const trimTrailingSlash = (value) => value.replace(/\/+$/, '')

const defaultApiUrl = 'http://127.0.0.1:8000/api'
const defaultAssetUrl = 'http://127.0.0.1:8000'

export const API_URL = trimTrailingSlash(import.meta.env.VITE_API_URL || defaultApiUrl)
export const ASSET_URL = trimTrailingSlash(import.meta.env.VITE_ASSET_URL || defaultAssetUrl)
