<?php

/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */
$metadata['https://adfs.slac.stanford.edu/adfs/services/trust'] = [
  'entityid' => 'https://adfs.slac.stanford.edu/adfs/services/trust',
  'description' => [
    'en-US' => 'SLAC National Accelerator Laboratory',
  ],
  'OrganizationName' => [
    'en-US' => 'SLAC National Accelerator Laboratory',
  ],
  'name' => [
    'en-US' => 'SLAC National Accelerator Laboratory',
  ],
  'OrganizationDisplayName' => [
    'en-US' => 'SLAC National Accelerator Laboratory',
  ],
  'url' => [
    'en-US' => 'https://www.slac.stanford.edu/',
  ],
  'OrganizationURL' => [
    'en-US' => 'https://www.slac.stanford.edu/',
  ],
  'contacts' => [
    [
      'contactType' => 'support',
      'givenName' => 'SLAC IT Help Desk',
      'emailAddress' => [
        'ithelp@slac.stanford.edu',
      ],
      'telephoneNumber' => [
        '650-926-4357',
      ],
    ],
  ],
  'metadata-set' => 'saml20-idp-remote',
  'SingleSignOnService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/ls/',
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/ls/',
    ],
  ],
  'SingleLogoutService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/ls/',
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/ls/',
    ],
  ],
  'ArtifactResolutionService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/services/trust/artifactresolution',
      'index' => 0,
    ],
  ],
  'NameIDFormats' => [
    'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
    'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
  ],
  'keys' => [
    [
      'encryption' => true,
      'signing' => false,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIDQDCCAiigAwIBAgIQerbmdqJYS6pIPBC+xqtk/jANBgkqhkiG9w0BAQsFADAzMTEwLwYDVQQDDChBREZTIEVuY3J5cHRpb24gLSBhZGZzLnNsYWMuc3RhbmZvcmQuZWR1MB4XDTE1MTIxMDA4MTgyMloXDTI1MTIwNzA4MTgyMlowMzExMC8GA1UEAwwoQURGUyBFbmNyeXB0aW9uIC0gYWRmcy5zbGFjLnN0YW5mb3JkLmVkdTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOqMKfmEB1kRbTex0HvYhE1uga8O3dTqkRi7w2AO7TVRydndphYYmg/RXWeAF5beAeZQ0++SUXC1teFvhnXI9/ye/4nfNW9ZnaS56ujHHvrhuIJNZ+Y/l6nQiNSq6hWH8mh80+0SeTXjq+Elsenq4BYIw8ZCesDCM58vgj3Ghx27cPpqZeFKKEGgvQK1l1ze6cYHGQIWXJqt9wpxlpOq8sk150mAu0Ulxs23oLH3O4RtJ5998XIBqZ0ragtGFnJccJZTtZJFrYVA+kXOgDO3P/cUabgY8cjuWKoPzGphWIcIcBJph8cIy6DGjs7QgpMF5D072G8OXhu7Vmw+JNJ0GbcCAwEAAaNQME4wHQYDVR0lBBYwFAYIKwYBBQUHAwEGCCsGAQUFBwMCMB0GA1UdDgQWBBQQQCwkQMVquGHJF2iQMX72PEyhhjAOBgNVHQ8BAf8EBAMCBSAwDQYJKoZIhvcNAQELBQADggEBALcmIoksVVf9966Q47VfqmF9CiyKU0Ej24ldcpTdP02BKA+peZMn12SxKJb1ycaBhnXzHy0HoocFSXzfYcYTNE5/Rrbc6EIRiENhtC7qUSMBBiZ46sXMYpG6307AFCUPkaM2sOhQmGEHavHneUDEDtglQ9hSfTOEj/qCGO43jkR4brQMFcXFJ8yQ0TJlxPxxOHrZOL2uI7DkWpnLUULOdF/lTTg3toPTWRZeXbutfokkWjCuYhu75pI6z2/A3VEHhl6ZDgdGQOfXiTDhjMsVyIS2am6+ETZrpothMYEEkI8iw8OsLTUP0g0WHZjZm2Ee9gSsIb9E7qpM4mfbo/FqPsU=',
    ],
    [
      'encryption' => false,
      'signing' => true,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIDRjCCAi6gAwIBAgIQP6aJillEl6tIT86I6FyvdDANBgkqhkiG9w0BAQsFADA2MTQwMgYDVQQDDCtBREZTIFRva2VuIFNpZ25pbmcgLSBhZGZzLnNsYWMuc3RhbmZvcmQuZWR1MB4XDTE1MTIxMDA4MTc1OVoXDTI1MTIwNzA4MTc1OVowNjE0MDIGA1UEAwwrQURGUyBUb2tlbiBTaWduaW5nIC0gYWRmcy5zbGFjLnN0YW5mb3JkLmVkdTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAMYuBEgpZUgPatQjN11koXEmubM3h6KbCb6jtbvVb78bNjedecD79ck1KijAWZBQETE/i8U4OggUlO8Vtv0kJtAgZGsvcOyav9g8O4UR3o2nXEh8VtQ/pc/JxaLshP1F19cA9vRIBLBMq3YoqYws9npAMmaQ9sFy+144m0wydSGEx8MZpPIfVgF0UlXH3WFo4G5u2bqYKEGxM3O2IhvgplFLHHGiB2irwTKZIv0izJo+cUKbWJVRhZ5aHoPjPyn2dnG+GnTjSPFG8RXjq8GLv+1azukwTyFjUwftdNfZj4263vl6tfHsBvPiyg3apvf0dK6T813g4Ls7egXmMcYLbssCAwEAAaNQME4wHQYDVR0lBBYwFAYIKwYBBQUHAwEGCCsGAQUFBwMCMB0GA1UdDgQWBBS3aNynz43DlgAf46Xib2Rq7eGzJTAOBgNVHQ8BAf8EBAMCBSAwDQYJKoZIhvcNAQELBQADggEBAHw5+uUhDpQ+2XsNoq7/8vPTvK8pwQDNvFRsjf9N+yBfSLrYouSdgTbj+3w4aLCHBt5Bi5BBfuCGZBu8Fc/TCy2b2GFuM3oYXwmY2UvHbPMpBfy6j0oULfDZ2ke2GbFo3HJkLbWSk/Akn/Uh3rDaXgQ5nf8onlGEOeE/nxvV3Z7D2Ld34QncVFCZWQgxebHOGMfya1XtDUs0yf1H80k/QeKsprITsDn+/ktLSA5jJoRxCLD29uK+kJLqcJ91UhUeQT+Wp7YwW3mTPtXmq1jpcEGgAF3oH+0PVM/XbRhr4UI/Wpdtj7wEDCrbBYiI2RdycxmGfITKxm/YNa5KX81AxBE=',
    ],
  ],
];

